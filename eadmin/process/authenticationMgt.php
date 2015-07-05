<?php
require_once("siteConfig.php");
class authenticationProcessor extends siteConfig {
	private $procCode = array();
	public function isAuthenticated() {

		if($this->isLogedIn()) {
		//print_r($this->procCode);
			if(!$this->hasAccess($this->procCode)){
				$this->redirectToURL(5);	
			}
			// redirect to DashBoard
			//$this->redirectToURL(2);
		}
		else
		{
			// redirect to Login Page
			$this->redirectToURL(1);		
		}		
	}
	public function exportAccess($val){
		$this->procCode = $val;
	}
	public function logedinUserDetails(){
		if($this->isLogedIn()){
			$arr = array("userID"=>$this->getCookie("userID"),
							"desigID"=>$this->getCookie("designation"),
							"userName"=>$this->getCookie("userName")
							);
							return $arr; 
		}else {
			return false;
		}
	}
	public function isRemoteUserAuthenticated($userRemoteTokenID,$dbconn){

		$obj_Authentication = new authenticationProcessor();
		$obj_Authentication->isAuthenticated();

		$sql_taskDetais = "SELECT * FROM tbl_user_mst WHERE authonticaionToken = '".$taskID."'";
		//$res = parent::queryExecuter($sql_taskDetais,$dbconn);	
		//return mysql_num_rows($res);		
	}
	
	public function setCookie($cookiename,$vlue,$time) {
		$time		= (!empty($time))?$time:time()+(24*60*60);	
		$path 		= $this->getcookiePath();
		$domain		= $this->getcookieDomain();
		
		//echo $cookiename." -- ".$vlue." -- ".$time." -- ".$path." -- ".$domain;
		//setcookie($cookiename,$vlue,$time,$path,$domain,true);	
		setcookie($cookiename,$vlue,$time,$path,$domain);	
	}
	
	public function getCookie($cookiename) {
		return $_COOKIE[$cookiename];
	}

	public function isLogedIn() {
	$cookievalue = $this->getCookie("userLogin");
		if(!empty($cookievalue))
			return true;
		else
			return false;
	}
	
	public function isNewRegistration() {
	$cookievalue = $this->getCookie("userRegistrationstatus");
		if(!empty($cookievalue))
			return true;
		else
			return false;
	}
	
	public function hasAccess($curentAccessToken){

		$arrUserRole = explode(",",$this->getCookie("accessDetails"));
		$isSuperAdmin	=  $this->getCookie("designation");
		if($isSuperAdmin == 1){
			return true;
		}
		if(is_array($curentAccessToken)){
			$containsAllValues =  array_intersect($curentAccessToken, $arrUserRole);			
			if(sizeof($containsAllValues) > 0){
				return true;
			}else{
				return false;
			}
		}else{
			if(in_array($curentAccessToken,$arrUserRole)){
				return true;
			}else{
				return false;
			}
		}

	}
	
	public function redirectToURL($urlid) {		
		switch($urlid)
		{
			case 1:
				header("Location:".$this->getAuthentictionFailedLogin());			
			break;
			case 2:
				header("Location:".$this->getDefaaultIndexURL());			
			break;
			case 3:
				header("Location:".$this->getLogOutPath());			
			break;
			case 4:
				header("Location:".$this->getLoginEmptyURL());			
			break;
			case 5:
				header("Location:".$this->getNoAccess());			
			break;
			case 6:
				header("Location:".$this->redirectToUserRegistration());			
			break;
			default:
				header("Location:".$this->getAuthentictionFailedLogin());		
			break;
		}
	}
	
}
?>