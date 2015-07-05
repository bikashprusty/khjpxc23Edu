<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edu : Login</title>
		<?php 
		require_once("process/authenticationMgt.php");
		$objAuth = new authenticationProcessor();
		 echo $objAuth->isLogedIn();
		if($objAuth->isLogedIn()){
			header("location: index.php");
		}
		include("include/header_include.php"); ?>
</head>

<body>
<div class="Container">
	<div class="header">
		<?php include("include/header.php"); ?>
	</div>
	<div class="middle loginPage">
		<div class="left formInter">
			<iframe name="submitForm" id="submitForm"></iframe>
					<div class="blockDetail loginWraper active">
						<?php
						if(isset($_REQUEST['msg'])){
						?>
						<div class="error message">
							<span>
							<?php
								$ch = $_REQUEST['msg'];
									switch($ch){
										case "errorLogin":
											echo "UserName or Password Are Wrong";
										break;
										case "loginAgain":
											echo "Login Agaian with Valid User Cridentials(empty values are restricted)";
										break;	
										case "logedOut":
											echo "Logged Out Successfuly";
										break;
										case "noAccess":
											echo "You donot have access to this Page";
										break;
											}
									?>
							</span>
						</div>									
							<?php
										} // if condition closes
									?>							
							<script type="text/javascript">
							$(document).ready(function(){
								setTimeout('timeout_trigger()', 5000);
							});
							function timeout_trigger(){
								if($(".error,.message").length == 1){
									$(".error,.message").fadeOut("5",function(){
										//$(this).remove();
									});
								}
									
							}
							</script>
							<div class="formWraper">
							<h3>Login Here</h3>
							<form name="loginUser" id="loginUser" method="post" action="bridges/userLogin/func_userLogin.php">
								<div class="formRow"><label for="genUserName">User Name</label></div>
								<div class="formRow"><input type="text" name="genUserName" id="genUserName" maxlength="200" autocomplete="off" /></div>
								<div class="formRow"><label for="genUserPass">Password</label></div>
								<div class="formRow"><input type="password" name="genUserPass" id="genUserPass" maxlength="200" autocomplete="off"></div>
								<div class="formRow"></div>								
								<div class="formRow">
									<a href="#forgot" id="forgotPass">Forgot Password</a> 
									<input type="hidden" name="formsubmit" id="formsubmit" value="1">
									<input type="submit" name="genUserLogin" id="genUserLogin" value="Login" />
								</div>
								<div class="formRow"></div>
							</form>
							</div>
					</div>
		</div>
	</div>
	<div class="footer">
			<?php include("include/footer.php"); ?>
	</div>
</div>
</body>
</html>
