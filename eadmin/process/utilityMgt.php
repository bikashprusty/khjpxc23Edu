<?php
require_once("siteConfig.php");
abstract class dbManagement extends siteConfig {
	
	private $host_;
	private $dbname_;
	private $username_;
	private $password_;
	
	private function setConnectionDetails($conn)
	{
		$this->sethost($conn['host']);
		$this->setDB($conn['db']);
		$this->setUserName($conn['username']);
		$this->setPassword($conn['password']);
	}
	
	private function sethost($val)
	{
		$this->host_ = $val;
	}
	
	private function gethost()
	{
		return $this->host_;
	}	
	
	private function setDB($val)
	{
		$this->dbname_ = $val;
	}
	
	private function getDB()
	{
		return $this->dbname_;
	}	
	
	private function setUserName($val)
	{
		$this->username_ = $val;
	}
	
	private function getUserName()
	{
		return $this->username_;
	}
	
	private function setPassword($val)
	{
		$this->password_ = $val;
	}

	private function getPassword()
	{
		return $this->password_;
	}
	
	private function startDBConnect()
	{
		$conn = mysql_connect($this->gethost(),$this->getUserName(),$this->getPassword());
		mysql_select_db($this->getDB(),$conn);
	}
	
	
	public function queryExecuter($sql,$dbConnection)
	{
		$this->setConnectionDetails($dbConnection);
		$this->startDBConnect();
		$res = mysql_query($sql);
		return $res;
	}
	
	public function NoNqueryExecuter($sql,$dbConnection)
	{
		$this->setConnectionDetails($dbConnection);
		$this->startDBConnect();
		mysql_query($sql);
		$last_insertID = mysql_insert_id();
		if(!empty($last_insertID))
		return $last_insertID;
		else
		return true;
		
	}
	
}

?>