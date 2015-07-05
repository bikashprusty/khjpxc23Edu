<?php
//echo md5('abhipassword');
require_once("../../include/config.php");
require_once("../../objectManagers/userLoginManager.php");
require_once("../../process/userMgt.php");

if(isset($_POST['formsubmit']) && $_POST['formsubmit'] == 1)
{
	$userName = $_POST['genUserName'];
	$password = $_POST['genUserPass'];

	$replace_arr = array("#","/","\/","=",">","<","!","&","(",")");
	$userName = str_replace($replace_arr,"",$userName);
	$password = str_replace($replace_arr,"",$password);
	$objLUMngr = new userLoginManager();
	
	$objLUMngr->setUserName($userName);
	$objLUMngr->setPassword($password);

	$objLoginUser = new userLoginProcessor();
	$objLoginUser->checkLogin($objLUMngr,$arrDBTaskManagement);

}
?>