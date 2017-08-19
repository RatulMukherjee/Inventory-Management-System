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
	public function getPid() {
		return $this->pid;
	}

	public function setCid($cid) {
		$this->cid=$cid;
	}
	public function getCid() {
		return $this->cid;
	}

	public function setName($name) {
		$this->name=$name;
	}
	public function getName() {
		return $this->name;
	}

	public function setModel($model) {
		$this->model=$model;
	}
	public function getModel() {
		return $this->model;
	}

	public function setQuantity($quantity) {
		$this->quantity=$quantity;
	}
	public function getQuantity() {
		return $this->quantity;
	}

	public function setPrice($price) {
		$this->price=$price;
	}
	public function getPrice() {
		return $this->price;
	}

	public function setGst($gst) {
		$this->gst=$gst;
	}
	public function getGst() {
		return $this->gst;
	}
}
?>