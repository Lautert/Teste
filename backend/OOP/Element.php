<?php
	require_once 'Component.php';

	class Element extends Component{

		private $string = null;

		public function __construct($string){
			$this->string = $string;
		}

		public function getElements(){
			return new ElementIterator([$this]);
		}
	}