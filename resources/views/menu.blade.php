<?php $resourcesPath = "../resources/assets/"; ?>
@extends('layouts.main')

@section('content')
            <div class = "menu">
				<div class = "menu_item left">
					<div class = "menu_item_box">
					<img src = "<?php echo $resourcesPath; ?>img/products.png" >
					</div>
					<div class = "menu_item_text">Products</div>
				</div>
				<div class = "menu_item left">
					<div class = "menu_item_box">
					<img src = "<?php echo $resourcesPath; ?>img/customers.png" >
					</div>
					<div class = "menu_item_text">Customers</div>
				</div>
				<div class = "menu_item left">
					<div class = "menu_item_box">
					<img src = "<?php echo $resourcesPath; ?>img/users.png" >
					</div>
					<div class = "menu_item_text">Users</div>
				</div>
				<div class = "menu_item left">
					<div class = "menu_item_box">
					<img src = "<?php echo $resourcesPath; ?>img/deal.png" >
					</div>
					<div class = "menu_item_text">Deals</div>
				</div>
				<div class = "menu_item left">
					<div class = "menu_item_box">
					<img src = "<?php echo $resourcesPath; ?>img/settings.png" >
					</div>
					<div class = "menu_item_text">Site Settings</div>
				</div>
				<div class = "menu_item left">
					<div class = "menu_item_box">
					<img src = "<?php echo $resourcesPath; ?>img/help.png" >
					</div>
					<div class = "menu_item_text">Get Help</div>
				</div>
				<div class = "clear"> </div>
			</div>
			<div class = "clear" > </div>
@endsection
