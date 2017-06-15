<!doctype>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mainStyle.css') }} ">
	<title>JobCorner.com</title>
</head>
<body>
    @include('components.banner')
	<div class = "main_container">
		<div class = "content">
			@section('content')

			@show
		</div>
		
		<div class = "footer">
		</div>
	</div>
</body>
</html>