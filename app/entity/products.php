<?php
class products {
	var $pid;
	var $cid;
	var $name;
	var $model;
	var $quantity;
	var $price;
	var $gst;

	public function setPid($pid) {
		$this->pid=$pid;
	}
	public function getPid($pid) {
		return $this->pid;
	}

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

	public function setModel($model) {
		$this->model=$model;
	}
	public function getModel($model) {
		return $this->model;
	}

	public function setQuantity($quantity) {
		$this->quantity=$quantity;
	}
	public function getQuantity($quantity) {
		return $this->quantity;
	}

	public function setPrice($price) {
		$this->price=$price;
	}
	public function getPrice($price) {
		return $this->price;
	}

	public function setGst($gst) {
		$this->gst=$gst;
	}
	public function getGst($gst) {
		return $this->gst;
	}
}
?>