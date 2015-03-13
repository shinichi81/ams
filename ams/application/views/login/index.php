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
<div class="wrapper">
    <div class="container">      	
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