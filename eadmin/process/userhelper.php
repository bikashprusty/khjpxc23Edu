<?php
require_once("utilityMgt.php");

class userhelper extends dbManagement{
	
	public function uniqueKeygenerator(){
		
		$token = md5(uniqid(mt_rand().date("ddmmyyyy").time("smh"), true));
		
		return $token; 
	}	
		
	public function isUserExist($userName,$dbconn){
		
		$sql_taskDetais = "SELECT user_name FROM tbl_user_mst WHERE user_name = '".$userName."'";
		$res =$this->queryExecuter($sql_taskDetais,$dbconn);	
		if(mysql_num_rows($res) >= 1)
		{		
			return true;
		}
		else
		{
			return false;	
		}
				
	}
}

?>