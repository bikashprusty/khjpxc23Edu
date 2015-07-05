<?php

class siteConfig {
	private $config;	
	
	function __construct() {
			$cookieparams = session_get_cookie_params();
			$this->config = array(
							"cookieDomain"=>$cookieparams['domain'],
							"cookiePath"=>"/",
							"authentiction_fail_loginURL"=>"http://localhost/edu/eadmin/login.php",
							"defaaultIndex"=>"http://localhost/edu/eadmin/",
							"logOutPath"=>"../../login.php",
							"indexPage"=>"http://localhost/edu/eadmin/index.php"																	
			);
	}
	
	public function getAuthentictionFailedLogin()
	{
		return $this->config["authentiction_fail_loginURL"]."?msg=errorLogin";
	}
	
	public function getDefaaultIndexURL()
	{
		return $this->config["defaaultIndex"];	
	}
	public function getLoginEmptyURL(){
		return $this->config["authentiction_fail_loginURL"]."?msg=loginAgain";
	}
	public function getcookiePath()
	{
		return $this->config["cookiePath"];
	}
	public function getLogOutPath()
	{
		return $this->config["logOutPath"]."?msg=logedOut";
	}
	public function getcookieDomain()
	{
		return $this->config["cookieDomain"];
	}
	public function getNoAccess()
	{
		return $this->config["authentiction_fail_loginURL"]."?msg=noAccess";
	}
	
	public function redirectToUserRegistration(){
		return $this->config["indexPage"]."?msg=reg_error";
	}
		
}
?>