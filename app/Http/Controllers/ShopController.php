<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CheckoutProductController;
use App\Models\Product;
use App\Models\Cart;

use Auth;
use Validator;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::All();
        return view('shop', ['products' => $products, 'name' => Auth::user()->name]);
    }
    
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_quantity' => 'integer|min:1'
        ]);
        
        if ($validator->fails())
        {
            return redirect('shop/')
                        ->withErrors($validator);
        }
        
        
        //add to cart validation was successfull
        $cart = new Cart();
        $cart->customer_id = Auth::user()->customer_id;
        $cart->product_id = $request->product;
        $cart->quantity = $request->cart_quantity;
        $cart->save();
        
        $products = Product::All();
        return view('shop', ['products' => $products, 'name' => Auth::user()->name, 'success_message' => "You have successfully added item(s) to the cart. "]);
    }
    
    public function viewCart()
    {
        $customer_id = Auth::user()->customer_id;
        
        $order_details['cart'] = [];
        
        $cart = Cart::where('customer_id', $customer_id)
                    ->where('deleted_at', null)
                    ->orderBy('product_id','asc')
                    ->get(); 
        
        $product_id = "";
        foreach($cart as $cart_item)
        {
            if( $product_id!="" && $product_id == $cart_item->product_id)
            {
                $product_quantity = $product_quantity + $cart_item->quantity;
            }
            else
            { //initial loop or new product
            
                if($product_id != "")
                {
                    $product_model = Product::select('product_name', 'price', 'description')
                                            ->where('id', $product_id)
                                            ->first();
                    array_push($order_details['cart'], ['product_id'=>$product_id
                                                    , 'quantity'=>$product_quantity
                                                    , 'product_name' => $product_model->product_name
                                                    , 'price' => $product_model->price
                                                    , 'cart_item_total' => ($product_model->price * $product_quantity)
                                                    , 'description' => $product_model->description ] );
                }
                $product_id = $cart_item->product_id;
                $product_quantity = $cart_item->quantity;
            }
        }
        
        //set last order detail
        $product_model = Product::select('product_name', 'price', 'description')
                                ->where('id', $product_id)
                                ->first();
        array_push($order_details['cart'], ['product_id'=>$product_id
                                        , 'quantity'=> $product_quantity
                                        , 'product_name' => $product_model->product_name
                                        , 'price' => $product_model->price
                                        , 'cart_item_total' => ($product_model->price * $product_quantity)
                                        , 'description' => $product_model->description ] );
        
        $checkoutProductController = new CheckoutProductController();
        
        $calculatedCart = $checkoutProductController->calculateCart($customer_id, $order_details['cart']);
        
        return view("cart", ["cart" => $order_details['cart'],
                            "total_due" => $calculatedCart['total_due'],
                            "order_discounts" => $calculatedCart['order_discounts'],
                            "order_freebies" => $calculatedCart['order_freebies'],
                            "name" => Auth::user()->name ]);
    }
}