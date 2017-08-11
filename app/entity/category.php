<?php
class category {
	var $cid;
	var $name;
	var $type;
	var $brand;

	public function setCid($cid) {
		$this->cid=$cid;
	}
	public function getCid($cid) {
		return $this->cid;
	}

	public function setName($name) {
		$this->name=$name;
	}
	public function getName($name) {
		return $this->name;
	}

	public function setType($type) {
		$this->type=$type;
	}
	public function getType($type) {
		return $this->type;
	}

	public function setBrand($brand) {
		$this->brand=$brand;
	}
	public function getBrand($brand) {
		return $this->brand;
	}
}
?>