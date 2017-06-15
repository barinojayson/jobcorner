<!doctype>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mainStyle.css') }}">
	<title>JobCorner.com</title>
</head>
<body>
	<div id = "banner">
		<div class = "center_div_80per text_top_20pix">
			<div class = "head_text1"> jobCorner.com </div>
		</div>
	</div>
	<div class = "main_container">
		<div id = "login_box">
		        <div class = "head_text1" > Welcome to jobCorner.com </div>
<br/>
                <form action="{{ url('login') }}" method="POST">
                    <br/>
                    <br/>
                    Email: <br/>
                    <input type = "text" class = "itext" name = "email" /> <br/><br/>
                    Password: <br/>
                    <input type = "password" class = "itext" name = "password" /> <br/><br/>
                    {{ csrf_field() }}
                    <input type = "submit" class = "ibutton2" value = "Login" />
                    <div class = "clear"> </div>
                </form>
                <?php if(isset($error)): ?>
                    <div class = "error_container">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>		        
		</div>
		
		<div class = "footer">
		</div>
	</div>
</body>
</html>