<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderFreebie;
use App\Services\ProductCheckoutBuilder;

class CheckoutProductController extends Controller {
	
	/**
	 * Retrieves the list of customers
	 * 
	 * @param $request Request
	 *
	*/
    public function checkout(Request $request)
    {

		$builder = new ProductCheckoutBuilder();
		
		$order = new Order();
		$order->customer_id = $request->customer_id;
		$builder->setOrder($order);
		
		collect($request->cart)->map(function($order) use ($builder) {
			$order_detail = new OrderDetail();
			$order_detail->product_id = $order['product_id'];
			$order_detail->quantity = $order['quantity'];
			$builder->add($order_detail);
		});
		$builder->checkout();
    }
    
    public function calculateCart($customer_id, $order_details)
    {
		$builder = new ProductCheckoutBuilder();
		
		$order = new Order();
		$order->customer_id = $customer_id;
		$builder->setOrder($order);
		
		collect($order_details)->map(function($order) use ($builder) {
			$order_detail = new OrderDetail();
			$order_detail->product_id = $order['product_id'];
			$order_detail->quantity = $order['quantity'];
			$builder->add($order_detail);
		});
		
		
		return $builder->calculate();
		
    }
}