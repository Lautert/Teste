<?php
	require_once 'Component.php';
	require_once 'ComponentIterator.php';
	require_once 'ElementIterator.php';

	class Composite extends Component{

		private $components = null;

		public function __construct(ComponentIterator $components){
			$this->components = $components;
		}

		public function getElements(){
			$elements = [];

			$this->components->reset();
			while($this->components->hasNext()){
				$component = $this->components->next();
				$component->getElements()->reset();
				while($component->getElements()->hasNext()){
					$elements[] = $component->getElements()->next();
				}
			}
			return new ElementIterator($elements);
		}
	}