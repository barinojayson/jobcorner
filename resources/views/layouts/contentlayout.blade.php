<!doctype>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mainStyle.css') }}">
	<title>JobCorner.com Add Deals</title>
</head>
<body>
	@include('layouts.banner')
	<div class = "main_container">
		<div class = "content">
			
			@section('content')
			@show
		
			<div class = "right_menu right">
				<div class = "head_text1">Jump to...</div>
				<div class = "menu_item_small left">
					<div class = "menu_item_box_small">
					<img src = "{{ URL::asset('img/products.png') }}" >
					</div>
					<div class = "menu_item_text">Products</div>
				</div>
				<div class = "menu_item_small left">
					<div class = "menu_item_box_small">
					<img src = "{{ URL::asset('img/customers.png') }}" >
					</div>
					<div class = "menu_item_text">Customers</div>
				</div>
				<div class = "clear"> </div>
				<div class = "menu_item_small left">
					<div class = "menu_item_box_small">
					<img src = "{{ URL::asset('img/users.png') }}" >
					</div>
					<div class = "menu_item_text">Users</div>
				</div>
				<div class = "menu_item_small left">
					<div class = "menu_item_box_small">
					<img src = "{{ URL::asset('img/deal.png') }}" >
					</div>
					<div class = "menu_item_text">Deals</div>
				</div>
				<div class = "clear"> </div>
				<div class = "menu_item_small left">
					<div class = "menu_item_box_small">
					<img src = "{{ URL::asset('img/settings.png') }}" >
					</div>
					<div class = "menu_item_text">Site Settings</div>
				</div>
				<div class = "menu_item_small left">
					<div class = "menu_item_box_small">
					<img src = "{{ URL::asset('img/help.png') }}" >
					</div>
					<div class = "menu_item_text">Get Help</div>
				</div>
				<div class = "clear"> </div>
			</div>
			<div class = "clear"></div>
		</div>
		
		<div class = "footer">
		</div>
	</div>
</body>
</html>