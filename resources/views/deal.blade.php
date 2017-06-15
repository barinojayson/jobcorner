<?php $resourcesPath = "../resources/assets/"; ?>
@extends('layouts.contentlayout')
@section('content')
    <div class = "left_content left">
		<div class = "head_text1">  View Deals </div>
		<br />
		
			<a href = "/public/deal/add"><div class = "dbutton"> Add Deals </div></a>
			<div class = "clear"></div>
			
			@foreach ($deals as $deal)
			
			<div class = "large_cell">
				<div class = "large_cell_top_text">
				Last updated on {{ $deal->updated_at }}
				</div>
				<div class = "large_cell_main_text">
			    	{{ $deal->deal_name }}
				</div>
				<input type = "button" class = "ibutton" value = "Edit" />
				<input type = "button" class = "ibutton" value = "Delete" />
				<input type = "button" class = "ibutton" value = "Offer to Clients" />
			</div>
			
            @endforeach
	</div>
@endsection
