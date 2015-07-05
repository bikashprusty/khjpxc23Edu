<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edu : Home</title>
		<?php include("include/header_include.php"); ?>
</head>

<body>
<div class="Container">
	<div class="header">
		<?php 
		include("include/header.php"); ?>
	</div>

		<?php
		include("process/authenticationMgt.php");
		$objAuth = new authenticationProcessor();
		//$objAuth->getCookie("authenticationToken");
		if(!$objAuth->isLogedIn()){
		?>
			<div class="middle nonLogin">
		<?php
			include("include/preLogin.php");
		?>
			</div>
		<?php	
		}else{
		?>
			<div class="middle dashboard">
		<?php
			include("include/postLogin.php");		
		?>
			</div>
		<?php				
		}
		?>
	</div>
	<div class="footer">
			<?php include("include/footer.php"); ?>
	</div>
</div>
</body>
</html>
