<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\DealCriteria;
use App\Models\Order;
use App\Models\Customer;
use App\Models\CustomerOffer;
use App\Models\Deal;
use App\Models\OrderFreebie;

class ProductCheckoutBuilder
{
    protected $order;
    protected $order_details;
    protected $order_freebies;
	protected $cart_items;
	protected $total_due;
	protected $discounts;
	protected $display_freebies;
	protected $product_accounted;
    
    public function __construct()
    {
        $this->order_details = collect();	
        $this->order_freebies = collect();	
        $this->display_freebies = collect();
        $this->discounts = collect();
		$total_due = 0;
    }
	
	public function add(OrderDetail $order_detail)
	{
		$this->order_details->push($order_detail);		
	}

	public function save()
	{
		$this->order_details->map(function($item) {
			$item->save();
		});
	}
	
	public function updateTotalDue()
	{
	   $product = new Product();
		foreach($this->order_details as $order_detail)
		{
			if(!isset($order_detail->price))
			{ //product was not subjected for discounts
			
				$product = Product::whereId($order_detail->product_id)->first();
				$order_detail->discount = 0;
				$order_detail->price = $product->price;
				$this->total_due = $this->total_due + ($order_detail->quantity * $order_detail->price);
			}
		} 
	}
	
	public function setOrderDetailDiscountAndPrice($product_id, $discount)
	{
		$product = new Product();
		foreach($this->order_details as $order_detail)
		{
			if($product_id == $order_detail->product_id)
			{
				$product = Product::whereId($product_id)->first();
				$order_detail->discount = $discount;
				$order_detail->price = $product->price;
				$this->total_due = $this->total_due + ($order_detail->quantity * ($order_detail->price - $discount));
				$this->discounts->push(["product_id" => $product_id, "product_name" => $product->product_name, "discount" => $discount * $order_detail->quantity]);
			}
		}
	}
	
	public function addFreebies($product_id, $quantity)
	{
		$freebie = new OrderFreebie();
		//$freebie->order_id = $this->order->id;
		$freebie->product_id = $product_id;
		if(!isset($freebie->quantity))
		{
		    $freebie->quantity = 0;
		}
		
		$freebie->quantity = $freebie->quantity + $quantity;
		
		$this->order_freebies->push($freebie);
		
		$product = Product::whereId($product_id)->first();
		
		$product_found = false;
		foreach($this->display_freebies as $key => $free_prod)
		{
		    if($free_prod['product_id'] = $product_id)
		    {
		        $this->display_freebies[$key]['quantity'] = $freebie->quantity;
		        $product_found = true;
		    }
		}
		if(!$product_found)
		{
		    $this->display_freebies->push(["product_id" => $product_id, "quantity" => $freebie->quantity, "product_name" => $product->product_name]);
		}
	}
	
	public function getCustomerDeals()
	{
		$relations = [
			'deal.criteria',
			'deal.offer'
		];
		
		$customer_offers = CustomerOffer::with($relations)
						->where(["customer_id" => $this->order->customer_id ] )
						->orderBy("priority", "asc")
						->get();
		//dd($customer_offers->toArray());
		return $customer_offers;
	}
	
	public function setOrder(Order $order)
	{
		$this->order = $order;
	}
	
	public function calculate()
	{	
		$this->cart_items = $this->order_details->toArray();
		
		//dd($this->cart_items);
		
		//get all deals from the customer
		$customer_deals = $this->getCustomerDeals();
		
		foreach($customer_deals as $customer_deal)
		{
            foreach($customer_deal->deal as $deal)
            {
                //evaluate the criteria if met in the cart
                $evaluationResult = $this->evaluateCriteria($deal);
				
                if($evaluationResult['deal_criteria_matched']) 
                {
					//determine the offers
                    $this->setOffers($deal, $evaluationResult['product_multiplier']);
                }
            }
		}
		
		$this->updateTotalDue();
		
		//dd($this->discounts->toArray());
	
		return ["total_due" => $this->total_due, "order_discounts" => $this->discounts->toArray(), "order_freebies" => $this->display_freebies->toArray()];
	}
	
	public function setOffers($deal, $product_multiplier)
	{
		//identify the offer(s)
		foreach($deal->offer as $offer)
		{
			if(!is_null($offer->quantity))
			{
				$this->addFreebies($offer->product_id, ($offer->quantity * $product_multiplier));
			}
			if(!is_null(($offer->amount)))
			{
				foreach($this->cart_items as $cart_item)
				{
					if($cart_item["product_id"] == $offer->product_id)
					{
						//set the discount for the price
						$cart_item["discount"] = $offer->amount;
						//tag all these products as accounted to prevent the discounted products from being used in another deals
						$product_accounted[$offer->product_id] = $cart_item["quantity"];
						$this->setOrderDetailDiscountAndPrice($offer->product_id, $offer->amount);
					}
				}
			}
		}
		
	}
	
	public function evaluateCriteria($deal)
	{
	    $product_multiplier = 0;
	    $prod_accounted_temp = [];
		$deal_criteria_matched = true;
		$product_multiplier_now = 0;
		foreach($deal->criteria as $criteria)
		{
			if($deal_criteria_matched) //if previous deal criteria matched
			{
				$deal_criteria_matched = false; //initiate the found flag to false
				foreach($this->cart_items as $cart_item)
				{
					if($criteria->product_id == $cart_item['product_id'])
					{
						if(!isset($prod_accounted_temp[$criteria->product_id]))
						{
						    //set temporary accounted products
							$prod_accounted_temp[$criteria->product_id] = 0;
						}
						
						if(!isset( $this->product_accounted[$criteria->product_id]))
						{
						    //set accounted products in class instance
						    $this->product_accounted[$criteria->product_id] = 0;
						}
						
						$remaining_quantity = ($cart_item['quantity'] - ($prod_accounted_temp[$criteria->product_id] + $this->product_accounted[$criteria->product_id]));
						if($criteria->quantity <= $remaining_quantity)
						{
						    $product_multiplier_now = floor($remaining_quantity / $criteria->quantity);
						    if($product_multiplier == 0)
						    {
						        //initiate product_multiplier
						        $product_multiplier = $product_multiplier_now;
						    }
						    else if($product_multiplier_now < $product_multiplier)
						    {
						        $product_multiplier = $product_multiplier_now;
						    }
							//product matched
							//set accounted quantity
							$prod_accounted_temp[$criteria->product_id] = $this->product_accounted[$criteria->product_id] + $prod_accounted_temp[$criteria->product_id] + ($criteria->quantity * $product_multiplier);
							//set the match flag to true to mark the current criteria matched in the cart
							$deal_criteria_matched = true; 
						}
					}
				}
			}
		}
		
		if($deal_criteria_matched)
		{
		    //all product requirement are met. update the accounted products
		    foreach($prod_accounted_temp as $prod_id => $quantity)
		    {
		        $this->product_accounted[$prod_id] = $quantity / $product_multiplier;
		    }
		}
		
		return ['deal_criteria_matched' => $deal_criteria_matched, 'product_multiplier' => $product_multiplier];
	}
	
	public function checkout()
	{
		$total_due = $this->calculate();
		$product = new Product();
		
		//save order
		$this->order->total_amount = $total_due;
		$this->order->save();
		
		//save freebies
		$this->order_freebies->map(function($item) {
			$item->order_id = $this->order->id;
			$item->save();
		});

		//save order details
		$this->order_details->map(function($item) {
			$item->order_id = $this->order->id;
			$item->save();
		});		
		return $total_due;
	}
	
}