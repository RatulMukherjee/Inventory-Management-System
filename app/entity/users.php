<?php
class users {
	var $uid;
	var $uname;
	var $password;
	var $email;
	var $acc_type;

	public function setUid($uid) {
		$this->uid=$uid;
	}
	public function getUid($uid) {
		return $this->uid;
	}

	public function setUname($uname) {
		$this->uname=$uname;
	}
	public function getUname() {
		return $this->uname;
	}

	public function setPassword($password) {
		$this->password=$password;
	}
	public function getPassword() {
		return $this->password;
	}

	public function setEmail($email) {
		$this->email=$email;
	}
	public function getEmail() {
		return $this->email;
	}

	public function setAcc_type($acc_type) {
		$this->acc_type=$acc_type;
	}
	public function getAcc_type() {
		return $this->acc_type;
	}
}
?>