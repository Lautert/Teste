<?php
	class AxisPoint{
		private $x = null;
		private $y = null;

		public function __construct($x, $y){
			$this->x = $x;
			$this->y = $y;
		}

		public function getPoint(){
			return [$this->x, $this->y];
		}
	}