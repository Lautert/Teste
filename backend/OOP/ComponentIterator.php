<?php
	require_once 'Iterator.interface.php';

	class ComponentIterator implements It{

		private $pos = 0;
		private $components = [];

		public function __construct(Array $components){
			$this->components = $components;
		}

		public function hasNext(){
			return ($this->pos >= count($this->components) || $this->components[$this->pos] == null) ? false : true;
		}
		public function next(){
			return $this->components[$this->pos++];
		}
		public function reset(){
			$this->pos = 0;
		}
	}