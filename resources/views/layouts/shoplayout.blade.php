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
				
				@section('right_content')

				@show
				
			</div>
			<div class = "clear"></div>
		</div>
		
		<div class = "footer">
		</div>
	</div>
</body>
</html>