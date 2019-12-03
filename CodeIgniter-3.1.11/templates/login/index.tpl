<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>easyWeb</title>
    <link rel="stylesheet" href="{{$base_url.base_url}}templates/login/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{$base_url.base_url}}templates/login/css/style.css">
</head>

<body>
    <div class="materialContainer">
        <div class="box">
            <form action="{{$base_url.base_url}}user/login" method="post">
				<div class="title">Login</div>
				<div class="input">
					<label for="name">username</label>
					<input type="text" name="username" id="name">
					<span class="spin"></span>
				</div>
				<div class="input">
					<label for="pass">password</label>
					<input type="password" name="password" id="pass">
					<span class="spin"></span>
				</div>
				<div class="button login">
					<button type="submit">
						<span>login</span>
						<i class="fa fa-check"></i>
					</button>
				</div>
			</form>

        </div>

        <div class="overbox">
            <div class="material-button alt-2">
                <span class="shape"></span>
            </div>
            <form action="{{$base_url.base_url}}user/register" method="post">
				<div class="title">Register</div>
				<div class="input">
					<label for="regname">username</label>
					<input type="text" name="username" id="regname">
					<span class="spin"></span>
				</div>
				<div class="input">
					<label for="regpass">password</label>
					<input type="password" name="password" id="regpass">
					<span class="spin"></span>
				</div>
				<div class="button">
					<button type="submit">
						<span>registe</span>
					</button>
				</div>
			</form>
        </div>

    </div>
    <script src="{{$base_url.base_url}}templates/login/js/jquery.min.js"></script>
    <script src="{{$base_url.base_url}}templates/login/js/index.js"></script>
</body>

</html>
