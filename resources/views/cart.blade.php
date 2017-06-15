@extends('layouts.shoplayout')

@section('content')
    <div class = "left_content left">
		<div class = "head_text1"> Cart </div>
		<br />
			@isset($success_message)
			<div class = "success_container">
			    {{ $success_message }}
			</div>
			@endisset
			
			@if (count($errors) > 0)
                <div class="error_container">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </ul>
                </div>
            @endif
			
			@foreach ($cart as $cart_item)
    			<div class = "large_cell">
    				<div class = "large_cell_main_text">
        				{{ $cart_item['product_name'] }}
    				</div>
    				<div>
    				    <span class = "price">
    				       ${{ $cart_item['price'] }}
    				    </span> X {{ $cart_item['quantity'] }}
    				    <p>
    				       {{ $cart_item['description'] }} 
    				    </p>
    				</div>
    			</div>
            @endforeach;
			<div class = "clear"></div>
	</div>
@endsection

@section('right_content')
    @foreach ($cart as $cart_item)
		<div class = "cart_list">
				<div class = "cart_item"> {{ $cart_item['product_name'] }} </div>
				<div>
    				<span class = "cart_price"> ${{ $cart_item['price'] }} </span>
    				X
    				<span class = "cart_quantity"> {{ $cart_item['quantity'] }} </span>
    				<span class = "right bolder"> ${{ $cart_item['cart_item_total'] }} </span>
				</div>
		</div>
    @endforeach;
    <div class = "horizontal_fine">
    </div>
    
    @foreach ($order_discounts as $discount)
    <div class = "cart_list">
			<div>
				<span class = "cart_price blue"> {{ $discount['product_name'] }} discount </span>
				<span class = "right bolder blue"> -${{ $discount['discount'] }} </span>
			</div>
	</div>
	@endforeach
	
	<div class = "horizontal_broad">
    </div>
    
    <div class = "cart_list">
			<div>
				<span class = "right price"> {{ $total_due }} </span>
			</div>
			<div class = "clear"> </div>
	</div>
   
    @foreach ($order_freebies as $freebie)
    <div class = "cart_list_free">
			<div>
				<span class = "right"> FREE: {{ $freebie['quantity'] }} X {{ $freebie['product_name'] }} </span>
			</div>
			 <div class = "clear"> </div>
	</div>
	@endforeach
	
	<br />

	<span class = "right">
        <input type = "submit" name = "checkout" value = "Checkout" class = "dbutton" />
    </span>
    <span class = "right link_button">
        <a href = "{!! url('/shop'); !!}"> Continue Shopping </a>
    </span>
@endsection
