<div class="left formInter">
			<iframe name="submitForm" id="submitForm"></iframe>
			<ul>
			<?php 
			$tmp="";
				$tmp = 'login';
			//echo $tmp;
			?>
				<li class="<?php echo ($tmp == 'login')?"active":""; ?>">
					<div class="blockHead" id="userLoginDiv">User Login</div>
				</li>
			</ul>
			<div class="blockDetail userLoginDiv active">
					<div class="formWraper">
					<fieldset>
					<h3>Login here</h3>
					<form name="loginUser" id="loginUser" action="bridges/userLogin/func_userLogin.php" method="post" >
						<div class="formRow"><label for="genUserName">User Name</label></div>
						<div class="formRow"><input type="text" name="genUserName" id="genUserName" maxlength="200"></div>
						<div class="formRow"><label for="genUserPass">Password</label></div>
						<div class="formRow"><input type="password" name="genUserPass" id="genUserPass" maxlength="200"></div>
						<div class="formRow"></div>								
						<div class="formRow">
							<a href="#forgot" id="forgotPass">Forgot Password</a> 
							<input type="hidden" name="formsubmit" id="formsubmit" value="1">									
							<input type="submit" name="genUserLogin" id="genUserLogin" value="Login" />
						</div>
						<div class="formRow"></div>
					</form>
					</fieldset>
					</div>
			</div>
					
		</div>
		<div class="right">
			<p class="font3"></p>
		</div>