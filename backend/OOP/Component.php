<?php
	require_once 'ElementIterator.php';

	class Component{

		private $elements = null;

		public function __construct(ElementIterator $elements){
			$this->elements = $elements;
		}

		public function getElements(){
			return $this->elements;
		}
	}