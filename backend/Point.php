<?php
	require_once 'basics.php';
	require_once 'exceptions.php';

	class Link{

		private $origin = null;
		private $destination = null;
		private $distance = null;

		public function __construct(Point &$origin, Point &$destination, int $distance){
			$this->origin =& $origin;
			$this->destination =& $destination;
			$this->distance = $distance;
		}

		public function &getOrigin(){
			return $this->origin;
		}

		public function &getDestination(){
			return $this->destination;
		}

		public function getDistance(){
			return $this->distance;
		}
	}

	class Point{
		private $name = null;

		public function __construct($name){
			$this->name = $name;
		}

		public function getName(){
			return $this->name;
		}

		// EXEMPLO SIMPLES, MAS SERIA TUDO QUE IDENTIFICA O OBJETO
		public function getHash(){
			return $this->name;
		}
	}

	class Way{

		private $listPoint = [];

		public function hasPoint(Point $point){
			foreach ($this->listPoint as $k => $data){
				if($data->getHash() === $point->getHash()){
					return true;
				}
			}
			return false;
		}

		public function addPoint(Point &$point){
			$this->listPoint[] = $point;
		}

		public function getWay(){
			return $this->listPoint;
		}

		public function getEnd(){
			return $this->listPoint[count($this->listPoint)-1];
		}

		public function toString(){
			$string = [];
			foreach ($this->listPoint as $key => $point){
				$string[] = $point->getName();
			}
			return implode('->', $string);
		}
	}

	class Structure{

		private $name = null;

		private $listPoint = [];
		private $listLinks = [];

		public function __construct($name = 'structure'){
			$this->name = $name;
		}

		public function getName(){
			return $this->name;
		}

		public function hasPoint(Point $point){
			foreach ($this->listPoint as $k => $data){
				if($data->getHash() === $point->getHash()){
					return true;
				}
			}
			return false;
		}

		public function addPoint(Point &$point){
			if($this->hasPoint($point)){
				throw new FinalUserException("Você esta tentando adicionar o um ponto ja existente", 1);
			}
			$this->listPoint[] = $point;
		}

		private function &getPoint(Point $point){
			foreach ($this->listPoint as $k => $data){
				if($data->getHash() === $point->getHash()){
					return $this->listPoint[$k];
				}
			}
			return null;
		}

		private function linkExists(Point $origin, Point $destination){

			foreach ($this->listLinks as $k => $data){
				$linkOri = $data->getOrigin()->getHash();
				$linkDes = $data->getDestination()->getHash();
				if(
					$linkOri === $origin->getHash() &&
					$linkDes === $destination->getHash()
				){
					return true;
				}
				if(
					$linkOri === $destination->getHash() &&
					$linkDes === $origin->getHash()
				){
					return true;
				}
			}
			return false;
		}

		public function &getLinksByPoint(Point $point){
			$links = [];
			$pointHash = $point->getHash();
			foreach ($this->listLinks as $k => $data){

				$linkOri = $data->getOrigin()->getHash();
				$linkDes = $data->getDestination()->getHash();

				if($linkOri === $pointHash || $linkDes === $pointHash){
					$links[] =& $this->listLinks[$k];
				}
			}
			return $links;
		}

		public function addLink(Point $origin, Point $dest, int $distance){
			if(!$this->hasPoint($origin)){
				throw new FinalUserException("O ponto {$origin->getName()} não foi adicionado", 1);
			}

			if(!$this->hasPoint($dest)){
				throw new FinalUserException("O ponto {$dest->getName()} não foi adicionado", 1);
			}

			if($this->linkExists($origin, $dest)){
				throw new FinalUserException("O pontos {$origin->getName()} e {$dest->getName()} já foram interligados", 1);
			}

			$origin =& $this->getPoint($origin);
			$dest =& $this->getPoint($dest);

			$this->listLinks[] = new Link($origin, $dest, $distance);
		}

		private function recursiveSearch($point, $end, $way){
			$way->addPoint($point);

			if($point->getHash() === $end->getHash()){
				return [$way];
			}

			$ways = [];
			$links = $this->getLinksByPoint($point);
			foreach ($links as $k => $data){
				$curr = new Way();

				foreach ($way->getWay() as $i => $point){
					$curr->addPoint($point);
				}

				$linkOri = $data->getOrigin()->getHash();
				$linkDes = $data->getDestination()->getHash();

				$next = $point->getHash() === $linkOri ? $data->getDestination() : $data->getOrigin();
				if(!$curr->hasPoint($next)){
					$ways = array_merge_recursive($ways, $this->recursiveSearch($next, $end, $curr));
				}
			}
			return $ways;
		}

		public function searchConnection(Point $origin, Point $dest){
			if(!$this->hasPoint($origin)){
				throw new FinalUserException("O ponto {$origin->getName()} não foi adicionado", 1);
			}

			if(!$this->hasPoint($dest)){
				throw new FinalUserException("O ponto {$dest->getName()} não foi adicionado", 1);
			}

			$result = $this->recursiveSearch($origin, $dest, new Way());
			
			$ways = [];
			foreach ($result as $key => $way){
				$ways[] = $way->toString();
			}
			return $ways;
		}
	}