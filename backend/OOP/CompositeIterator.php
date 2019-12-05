<?php
	require_once 'Iterator.php';

	class CompositeIterator implements Iterator{

		private $pos = 0;
		private $composites = [];

		public function __construct(Array $composites){
			$this->composites = $composites;
		}

		public function hasNext(){
			return ($this->pos >= count($this->composites) || $this->composites[$this->pos] == null) ? false : true;
		}
		public function next(){
			return $this->composites[$this->pos++];
		}
		public function reset(){
			$this->pos = 0;
		}
	}