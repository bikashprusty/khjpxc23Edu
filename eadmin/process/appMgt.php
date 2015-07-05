<?php
require_once("utilityMgt.php");
require_once("authenticationMgt.php");

class applicationProcessor extends dbManagement {
	
	private static $procCode = array();
		
	function __construct()
	{
//		$obj_Authentication = new authenticationProcessor();
//		$obj_Authentication->exportAccess($this->procCode);			
//		$obj_Authentication->isAuthenticated();
	}

	public function exportAccess($val){
		$this->procCode = $val;		

		$obj_Authentication = new authenticationProcessor();
		$obj_Authentication->exportAccess($this->procCode);			
		$obj_Authentication->isAuthenticated();
	}
	
	
	function checkRemoteAuthentication($userRemoteToken)
	{
		$obj_Authentication = new authenticationProcessor();
		return $obj_Authentication->isRemoteUserAuthenticated($userRemoteToken);
	}	
	//	To get arry from Object
	function objectsIntoArray($arrObjData, $arrSkipIndices = array())
	{
		$arrData = array();
	   
		// if input is object, convert into array
		if (is_object($arrObjData)) {
			$arrObjData = get_object_vars($arrObjData);
		}
	   
		if (is_array($arrObjData)) {
			foreach ($arrObjData as $index => $value) {
				if (is_object($value) || is_array($value)) {
					$value = objectsIntoArray($value, $arrSkipIndices); // recursive call
				}
				if (in_array($index, $arrSkipIndices)) {
					continue;
				}
				$arrData[$index] = $value;
			}
		}
		return $arrData;
	}
	
	function redirectURL($url){
		header("Location:".$url);	
	}
	
}
?>