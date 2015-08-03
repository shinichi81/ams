<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="http://www.kompas.com/favicon.ico">
	<title>KCM - Ads Management System :: Login</title>
	<?php
		echo css("login.css");
	?>
</head>
<body>
<script type="text/javascript">
var count = 8;
var clock;
var redirect = "http://ams.kompas.com/2015";

function countDown(){
	var timer = document.getElementById("timer");
	if(count > 0){
			count--;
			timer.innerHTML = "Website akan diarahkan ke http://ams.kompas.com/2015 dalam waktu "+count+" detik.";
			clock = setTimeout("countDown()", 1000);
	}else{
			window.location.href = redirect;
	}
}

function stop() {
	// alert("tes");
	clearTimeout(clock);
}
</script>

<div class="wrapper">
    <div class="container">
			<div class="content-box">
				<span id="timer">
				<script type="text/javascript">countDown();</script>
				</span>
				<br><br>
				Silahkan klik tombol <input type="button" onclick="stop()" value="STOP" /> untuk tetap menggunakan ams versi lama.
			</div>
		<div class="content-box">
			<div class="content-box-header">
				<h3>KCM - Ads Management System :: Login</h3>
			</div>
			<div class="content-box-content">
				<form method="post" action="<?php echo site_url("login/auth"); ?>">
					<table align="center">
						<tr>
							<td><h4>Username</h4></td>
							<td><input type="text" name="txtUsername" /></td>
						</tr>
						<tr>
							<td><h4>Password</h4></td>
							<td><input type="password" name="txtPassword" /></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="btnLogin" value="Login" class="button" /></td>
						</tr>
					</table>
				</form>
			</div>
			<?php if ($isError): ?>
			<div class='error'>Username atau password salah!</div>
			<?php endif; ?>
		</div>
	</div>
</div>
</body>
</html>
