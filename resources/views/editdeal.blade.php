@extends('layouts.contentlayout')

@section('content')
    <div class = "left_content left">
        <form action="/public/deal/save" method="POST">
            
            <div class = "head_text1"> <?php echo $page_title; ?> </div>
            @if (count($errors) > 0)
                <div class="error_container">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </ul>
                </div>
            @endif
			<br />
			Step 1: Name your Deal: 
			<br />
			<br />
			<input type = "text" class = "itext" name = "deal_name" />
			<br />
			<br />

			<br />
			<br />
			Step 2: What are the qualifying criteria?
			<br />
			<br />
			<br />
			<div class = "small_cell border_right left">
				<strong> Product </strong>
			</div>
			<div class = "small_cell left">
				<strong> Quantity </strong>
			</div>
			<div class = "clear"></div>
			
			@foreach($products as $product)
			
    			<div class = "small_cell border_right left">
    				{{ $product->product_name }}
    			</div>
    			<div class = "small_cell left">
    				<input type = "text" class = "inum" name = "criteria_quantity[<?php echo $product->id; ?> ]" >
    			</div>
    			<div class = "clear"></div>
			
			@endforeach;

			<br />
			<br />			
			<br />
			Step 3: Specify the offer/s
			<br />
			<br />
			
			<div class = "small_cell border_right left">
				<strong> Product </strong>
			</div>
			<div class = "small_cell border_right left">
				<strong> Free Product </strong>
			</div>
			<div class = "small_cell left">
				<strong> Discount</strong>
			</div>
			<div class = "clear"></div>
			
			<?php foreach($products as $product): ?>
    		
    			<div class = "small_cell border_right left">
    				<?php echo $product->product_name;?>
    			</div>
    			<div class = "small_cell border_right left">
    				<input type = "text" class = "inum" name = "offer_quantity[<?php echo $product->id; ?>]" >
    			</div>
    			<div class = "small_cell left">
    				<input type = "text" class = "inum" name = "offer_discount[<?php echo $product->id; ?>]" >
    			</div>
    			<div class = "clear"></div>

			<?php endforeach; ?>

			<br />
			{{ csrf_field() }}
			<input type = "submit" class = "ibutton" value = "Save" />
			<input type = "button" class = "ibutton" value = "Cancel" />
         
        </form>
	</div>
@endsection
