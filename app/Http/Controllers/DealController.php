<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealOffer;
use App\Models\DealCriteria;
use App\Models\Product;

use Auth;

use Validator;

class DealController extends Controller
{
    
    public function index(Request $request)
    {
       $deals = Deal::orderBy('updated_at', 'desc')->get();
       return view('deal', ['deals' => $deals, 'name' => Auth::user()->name] );
    }
    
    public function update($id)
    {
       return view('editdeal', ['page_title' => 'Update Deal']);
    }
    
    public function add()
    {
        
       $products = Product::orderBy('id')->get();
       return view('editdeal', ['page_title' => 'New Deal', 'products' => $products, 'name' => Auth::user()->name]);
    }
    
    public function save(Request $request)
    {
       
        $criteria_quantities = $request->criteria_quantity;
        $offer_quantities = $request->offer_quantity;
        $offer_discounts = $request->offer_discount;
       
       //determine the product and quantity from criteria
       
        $criteria_product = array();
        
        foreach($criteria_quantities as $product_id => $quantity)
        {
            if(!is_null($quantity))
            {
                $criteria_product[$product_id]= $quantity;
            }
        }
       
       //determine the product and quantity from criteria
       
       $offers = array();
       
       foreach($offer_quantities as $product_id => $quantity)
        {
            if(!is_null($quantity))
            {
                $offers[$product_id]['quantity'] = $quantity;
            }
        }
        
        //determine the product and discount from offer
        
        foreach($offer_discounts as $product_id => $discount)
        {
            if(!is_null($discount))
            {
                $offers[$product_id]['discount'] = $discount;
            }
        }
       
        $validator = Validator::make($request->all(), [
            'deal_name' => 'required|max:255',
            'criteria_quantity.*' => 'sometimes|nullable|integer',
            'offer_quantity.*' => 'sometimes|nullable|integer',
            'offer_discount.*' => 'sometimes|nullable|integer'
        ]);
        
        $validator->sometimes('criteria', 'required', function ($input) use ($criteria_product)
                            {
                                return empty($criteria_product);
                            });
        
       $validator->sometimes('offers', 'required', function ($input) use ($offers)
                            {
                                return empty($offers);
                            });
        
        if ($validator->fails())
        {
            return redirect('deal/add')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $deal = new Deal();
        $deal->deal_name = $request->deal_name;
        $deal->save();
        
        foreach($criteria_product as $product_id => $quantity)
        {
            $deal_criteria = new DealCriteria();
            $deal_criteria->deal_id = $deal->id;
            $deal_criteria->product_id = $product_id;
            $deal_criteria->quantity = $quantity;
            $deal_criteria->save();
        }
        
        foreach($offers as $product_id => $offer)
        {
            $deal_offer = new DealOffer();
            $deal_offer->deal_id = $deal->id;
            $deal_offer->product_id = $product_id;
            
            if(isset($offer['quantity']))
            {
                $deal_offer->quantity = $offer['quantity'];
            }
            
            if(isset($offer['discount']))
            {
                $deal_offer->amount = $offer['discount'];   
            }
            
            $deal_offer->save();
        }
        
        return redirect('deal/');
    }
}