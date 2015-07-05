<?php
require_once("appMgt.php");
require_once("userhelper.php");

class userLoginProcessor extends applicationProcessor {
	
	private $userLogin_;
	private $userID_;
	private $username_;
	private $userSecretToken_;
	private $userDesignation_;
	
	public function checkLogin($params,$dbconn)
	{
		$objAoth = new authenticationProcessor();
		
		$username = $params->getUsername();
		$password = $params->getPassword();

		if(empty($username) || empty($password)){
			$objAoth->redirectToURL(4);exit;
		}
		$sql_Login =  "SELECT *,DATE_FORMAT(last_loggedin,'%D %b %Y, %W') lastLoggedIn FROM ".TABLE_USER_MASTER." WHERE user_name = '".$username."' AND user_password = '".md5($password)."'";
		$res = $this->queryExecuter($sql_Login,$dbconn);

		if(mysql_num_rows($res) == 1)
		{
		
			$objUser = mysql_fetch_object($res);		
		
			$accessString = implode(",",$this->getAccessforDesignation($objUser->desig_id,$dbconn));
			$objAoth->setCookie("userLogin",$objUser->uid,"");
			$objAoth->setCookie("userID",$objUser->uid,"");			
			$objAoth->setCookie("userName",$objUser->user_name,"");
			$objAoth->setCookie("authenticationToken",$objUser->authonticaionToken,"");
			$objAoth->setCookie("designation",$objUser->desig_id,"");
			$objAoth->setCookie("lastLogin",$objUser->lastLoggedIn,"");			
			$objAoth->setCookie("accessDetails",$accessString,"");			

			$objAoth->redirectToURL(2);exit;
		}
		else
		{
			$objAoth->redirectToURL(1);exit;
		}
	}
	
	public function logOutUser($dbconn)
	{

		$objAoth = new authenticationProcessor();

		$this->updateLastLogin($dbconn);

			$objAoth->setCookie("userLogin",$objUser->uid,time()-100);
			$objAoth->setCookie("userID",$objUser->uid,time()-100);			
			$objAoth->setCookie("userName",$objUser->user_name,time()-100);
			$objAoth->setCookie("authenticationToken",$objUser->authonticaionToken,time()-100);
			$objAoth->setCookie("designation",$objUser->desig_id,time()-100);
			$objAoth->setCookie("accessDetails","",time()-100);	
			$objAoth->setCookie("userRegistrations","","");			
			$objAoth->redirectToURL(3);exit;
	}			
	
	private function updateLastLogin($dbconn){
	
	$sql_updateLastLogin = "UPDATE ".TABLE_USER_MASTER." SET last_loggedin = NOW() WHERE uid = ".$_COOKIE['userID'];
	$res = $this->NoNqueryExecuter($sql_updateLastLogin,$dbconn);
		
	}
	
	private function getAccessforDesignation($dsigID,$dbconn){

		$desigArr = array();
		$sql_desigAccess = "SELECT * FROM ".TABLE_DESIG_ACCESS." WHERE desig_id = ".$dsigID;
		$resDesigAcc = $this->queryExecuter($sql_desigAccess,$dbconn);
		while($objDesigAcc = mysql_fetch_object($resDesigAcc)){
			array_push($desigArr,$objDesigAcc->access_id);
		}
		return $desigArr;
	}	
	
		
}
?>