<?php
	require_once 'Iterator.interface.php';

	class ElementIterator implements It{

		private $pos = 0;
		private $elements = [];

		public function __construct(Array $elements){
			$this->elements = $elements;
		}

		public function hasNext(){
			return ($this->pos >= count($this->elements) || $this->elements[$this->pos] == null) ? false : true;
		}
		public function next(){
			return $this->elements[$this->pos++];
		}
		public function reset(){
			$this->pos = 0;
		}
	}