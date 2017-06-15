@extends('layouts.shoplayout')

@section('content')
    <div class = "left_content left">
		<div class = "head_text1">  Shop </div>
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
			
			@foreach ($products as $product)    
    			<div class = "large_cell">
    				<div class = "large_cell_main_text">
        				<?php echo $product->product_name; ?>
    				</div>
    				<div>
    				    <p class = "price">
    				       {{ $product->price }}
    				    </p>
    				    <p>
    				        {{ $product->description }}
    				    </p>
    				</div>
    				<div class = "text_right">
    				    <form action="/public/shop" method="POST">
        				    Quantity: <input type = "text" class = "inum" name = "cart_quantity" />
        				    <input type = "hidden" value = "{{ $product->id }}" name = "product"  />
        				     {{ csrf_field() }}
        				    <input type = "submit" class = "ibutton" value = "Add to Cart" />
        				</form>
    				</div>
    			</div>
            @endforeach;
			<div class = "clear"></div>
	</div>
@endsection

@section('right_content')

	<a href = "/public/cart/view">
	    <div class = "menu_item_small left">
    		<div class = "menu_item_box_small">
    		<img src = "{{ URL::asset('img/cart.png') }}" >
    		</div>
    		<div class = "menu_item_text">View Cart</div>
	    </div>
	</a>
@endsection