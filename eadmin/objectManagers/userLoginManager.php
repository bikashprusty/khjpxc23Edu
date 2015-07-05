<?php

class userLoginManager {

	private $username_;
	private $password_;
	
	public function setUserName($val) {
		$this->username_ = $val;
	}

	public function getUserName() {
		return $this->username_;
	}

	public function setPassword($val) {
		$this->password_ = $val;
	}

	public function getPassword() {
		return $this->password_;
	}
}

class userRegistrationManager extends  userLoginManager{

	private $confpassword_;
	private $phone_;
	private $email_;
	
	public function setConfPassword($val) {
		$this->confpassword_ = $val;
	}

	public function getConfPassword() {
		return $this->confpassword_;
	}

	public function setPhone($val) {
		$this->phone_ = $val;
	}

	public function getPhone() {
		return $this->phone_;
	}
	
	public function setEmail($val) {
		$this->email_ = $val;
	}

	public function getEmail() {
		return $this->email_;
	}
}

class userProfileManager extends  userRegistrationManager{

	private $id_;
	private $fullname_;
	private $address_;
	private $dob_;
	private $lastloggedin_;
	
	public function setId($val) {
		$this->id_ = $val;
	}

	public function getId() {
		return $this->id_;
	}

	public function setFullname($val) {
		$this->fullname_ = $val;
	}

	public function getFullname() {
		return $this->fullname_;
	}
	
	public function setAddress($val) {
		$this->address_ = $val;
	}

	public function getAddress() {
		return $this->address_;
	}
	
	public function setDob($val) {
		$this->dob_ = $val;
	}

	public function getDob() {
		return $this->dob_;
	}
	
	public function setLastloggedin($val) {
		$this->lastloggedin_ = $val;
	}

	public function getLastloggedin() {
		return $this->lastloggedin_;
	}
}

?>