<div class="headContainer">
	<div class="logo">
		<a href="index.php"><img src="images/logo.png" alt="Site Logo" border="0" /></a>
	</div>
	<div class="topmenu">
		<ul>
			<li><a href="index.php" class="active">Home</a></li>
			<?php
				if(isset($_COOKIE['userName']) && !empty($_COOKIE['userName'])){
					?>
					<li><a href="articless.php">Articles</a></li>
					<li><a href="services.php">Category</a></li>
					<li><a href="photonvideo.php">phot/video</a></li>
					<li><a href="events.php">Events</a></li>
					<li><a href="enquiry.php">Enquiry</a></li>
					<li class="userStatus"><a href="profile.php">Welcome <?php echo $_COOKIE['userName']; ?> <span class="screen-reader-only"> click to edit your Profile</span></a> - <a href="bridges/userLogin/func_logOut.php">LogOut</a></li>
					<li></li>
					<?php
				}else{
					?>
					<li class="userStatus"><a href="login.php">Login</a></li>					
					<?php
				}
			?>
		</ul>
	<div class="clearall"></div>
</div>