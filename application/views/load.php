<!DOCTYPE html>
<html>
<head>
	<title>管理员登录</title>
	<meta charset='urf-8'>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/static/css/user.css">
	<script type="text/javascript" src='/static/js/jquery.js'></script>
	<script type="text/javascript" src='/static/js/user.js'></script>
</head>
<body>
<div class='userform'>
	<div class='usertitle'><h1>管理员登录</h1></div>
	<div class='inputbox'>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">用户名</span>
		  <input type="text" id='username' class="form-control" placeholder="" aria-describedby="basic-addon1">
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon2">密 &nbsp;&nbsp;&nbsp;码</span>
		  <input type="password" id='password' class="form-control" aria-describedby="basic-addon2" >
		</div>
		<div class="input-group">
			<!-- <span class="input-group-addon"> -->
			<div class='rember'>
				<input type="checkbox" >记住密码
			</div>
	      	<!-- </span>remember -->
			<button id='onload' class='btn btn-default'>登录</button>
		</div>
	</div>
	
</div>


</body>
</html>
