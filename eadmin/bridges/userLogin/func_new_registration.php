<?php
//echo md5('abhipassword');
require_once("../../include/config.php");
require_once("../../objectManagers/userLoginManager.php");
require_once("../../process/userMgt.php");

//echo md5("abhi123");


if(isset($_POST['formsubmit']) && $_POST['formsubmit'] == 1)
{	
	$userName = $_POST['genUserName'];
	$password = $_POST['genUserPass'];
	$conformPassword = $_POST['genUserConfPass'];
	$phone = $_POST['genUserPhone'];
	$email = $_POST['genUserEmail'];
	
	$replace_arr = array("#","/","\/","=",">","<","!","&","(",")");
	$userName = str_replace($replace_arr,"",$userName);
	$password = str_replace($replace_arr,"",$password);
	$conformPassword = str_replace($replace_arr,"",$conformPassword);
	$email = str_replace($replace_arr,"",$email);
	
	$objLUMngr = new userRegistrationManager();
	
	$objLUMngr->setUserName($userName);
	$objLUMngr->setPassword($password);
	$objLUMngr->setConfPassword($conformPassword);
	$objLUMngr->setPhone($phone);
	$objLUMngr->setEmail($email);
	
	$objLoginUser = new userLoginProcessor();
	$objLoginUser->addNewUser($objLUMngr,$arrDBTaskManagement);

}
?>