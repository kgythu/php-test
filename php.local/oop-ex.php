<?php
class Plus {
	private $a = 0;
	private $b = 0;
	private $c = 0;
	function __construct($a_param, $b_param) {
		$this->setA($a_param);
		$this->setB($b_param);
	}
	function getC() {
		return $this->c;
	}
	private function setC() {
		$this->c = $this->a + $this->b;
	}
	function setA($a_param) {
		$this->a = $a_param;
		$this->setC();
	}
	function setB($b_param) {
		$this->b = $b_param;
		$this->setC();
	}
}
class Prog {
	static function main() {
		$p = new Plus(23, 45);
		$c = $p->getC();
		echo $c;
	}
}
Prog::main();
?>