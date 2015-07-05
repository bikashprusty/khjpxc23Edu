<?php
//echo md5('abhipassword');
require_once("../../include/config.php");
require_once("../../process/userMgt.php");

	$objLoginUser = new userLoginProcessor();
	$objLoginUser->logOutUser($arrDBTaskManagement);

?>