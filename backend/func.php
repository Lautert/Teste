<?php
	require_once "basics.php";
	require_once "exceptions.php";
	require_once "AxisPoint.php";

	class Func{

		private static function rotateLeft($arr){
			$len = count($arr)-1;
			$f = $arr[0];
			for ($key=0; $key < $len; $key++){ 
				$arr[$key] = $arr[$key+1];
			}
			$arr[$key] = $f;
			return $arr;
		}

		private static function rotateRight($arr){
			$len = count($arr)-1;
			$f = $arr[$len];
			for ($key=$len; $key > 0; $key--){ 
				$arr[$key] = $arr[$key-1];
			}
			$arr[0] = $f;
			return $arr;
		}

		public static function rotateArray($arr, $pos, $left = true){
			$pos = $pos % count($arr);
			if($pos === 0) return $arr;

			for ($i=0; $i < $pos; $i++){ 
				$arr = $left ? self::rotateLeft($arr) : self::rotateRight($arr);
			}
			return $arr;
		}

		private static function selectionSort($arr, $asc = true){
			$len = count($arr)-1;
			$t = null;
			for ($i=$len; $i >= 0; $i--){ 
				$t = $i;
				for ($j=$i-1; $j >= 0; $j--){
					if(($asc && $arr[$j] > $arr[$t]) || (!$asc && $arr[$j] < $arr[$t])){
						$t = $j;
					}
				}
				// swap
				if (($asc && $arr[$i] < $arr[$t]) || (!$asc && $arr[$i] > $arr[$t])){
					$arr[$i] = $arr[$t] + $arr[$i];
					$arr[$t] = $arr[$i] - $arr[$t];
					$arr[$i] = $arr[$i] - $arr[$t];
				}
			}
			return $arr;
		}

		public static function oddEvenOrder($arr){
			$even = []; $odd = [];

			foreach ($arr as $key => $value){
				($value % 2 === 0) ? $even[] = $value : $odd[] = $value;
			}
			$even = self::selectionSort($even);
			$odd = self::selectionSort($odd,false);
			
			foreach ($odd as $key => $value){
				$even[] = $value;
			}
			return $even;
		}

		private static function validDate($day, $month, $year){
			// if(!is_int($day) || !is_int($month) || !is_int($year)) return false;
			if($year <= 0) return false;
			if(!($month >= 1 && $month <= 12)) return false;

			$finalDay = 31;
			if(in_array($month, [4,6,9,11])) $finalDay = 30;
			if($month == 2){
				$finalDay = (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) ? 29 : 28;
			}

			if(!($day >= 1 && $day <= $finalDay)) return false;
			return true;
		}

		public static function betweenDate($start, $end){
			try{
				preg_match('~(\d{2})/(\d{2})/(\d{4})~', $start, $dt1);
				preg_match('~(\d{2})/(\d{2})/(\d{4})~', $end, $dt2);

				$monthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

				if(empty($dt1) || !self::validDate($dt1[1], $dt1[2], $dt1[3])){
					throw new FinalUserException("A data inicial informada não é valida", 1);
				}

				if(empty($dt2) || !self::validDate($dt2[1], $dt2[2], $dt2[3])){
					throw new FinalUserException("A data final informada não é valida", 1);
				}

				$days1 = $dt1[3]*365+$dt1[1];
				for ($i=0; $i < $dt1[2]-1; $i++){ 
					$days1 += $monthDays[$i];
				}
				if($dt1[2] <= 2) $dt1[3]--;
				$leap1 = intval(($dt1[3] / 4) - ($dt1[3] / 100) + ($dt1[3] / 400));
				$days1 += $leap1;

				$days2 = $dt2[3]*365+$dt2[1];
				for ($i=0; $i < $dt2[2]-1; $i++){ 
					$days2 += $monthDays[$i];
				}
				if($dt2[2] <= 2) $dt2[3]--;
				$leap2 = intval(($dt2[3] / 4) - ($dt2[3] / 100) + ($dt2[3] / 400));
				$days2 += $leap2;
				
				return $days2 - $days1;// + ($leap2 - $leap1);

			}catch(FinalUserException $e){
				die($e->getMessage());
			}catch(Exception $e){
				die($e);
			}
		}

		private static function checkTriangle($a, $b, $c){
			return ($a + $b > $c) && ($a + $c > $b) && ($b + $c > $a);
		}

		private static function getAnglesByTriangle($a, $b, $c){

			$a2 = pow($a, 2);
			$b2 = pow($b, 2);
			$c2 = pow($c, 2);

			$alpha = (acos(($a2 - ($b2 + $c2))/(-2*$b*$c))) * 180 / pi();
			$betta = (acos(($b2 - ($a2 + $c2))/(-2*$a*$c))) * 180 / pi();
			$gamma = (acos(($c2 - ($a2 + $b2))/(-2*$a*$b))) * 180 / pi();

			return [$alpha, $betta, $gamma];
		}

		private static function triangleClassification($a, $b, $c){

			if($a === $b && $b === $c){
				$lengthType = 'equilátero';
			}else
			if(($a === $b && $a !== $c) || ($b === $c && $b !== $a)){
				$lengthType = 'isósceles';
			}else{
				$lengthType = 'escaleno';
			}

			$angles = self::getAnglesByTriangle($a, $b, $c);

			if($angles[0] < 90 && $angles[1] < 90 && $angles[2] < 90){
				$angleType = 'acutângulo';
			}else
			if($angles[0] == 90 || $angles[1] == 90 || $angles[2] == 90){
				$angleType = 'retângulo';
			}else
			if($angles[0] > 90 || $angles[1] > 90 || $angles[2] > 90){
				$angleType = 'obtusângulo';
			}

			return [$lengthType, $angleType];
		}

		public static function checkCombinations($a, $b, $c, $d, $e, $f){
			$values = func_get_args();

			$comb = [];
			foreach ($values as $i => $a){
				foreach ($values as $j => $b){
					foreach ($values as $k => $c){
						if($i != $j && $i != $k && $j != $k){
							if(self::checkTriangle($a, $b, $c)){
								$comb[] = [
									$a, $b, $c,
									self::triangleClassification($a, $b, $c)
								];
							}
						}
					}
				}
			}
			return $comb;
		}

		public static function searchInText($search, $paragraph){
			$results = [];

			$i = 0;
			$lenS = strlen($search);
			$lenP = strlen($paragraph);

			for ($k=0; $k < $lenP; $k++){ 
				$pLetter = $paragraph[$k];

				if($pLetter === $search[$i]){
					$i++;
				}else{
					$i = 0;
				}
				if($i == $lenS){
					$results[] = $k - ($lenS -1);
					$i = 0;
				}
			}

			return $results;
		}

		private static function rectangleOverlap($s1, $e1, $s2, $e2){
			return (($s1[0] > $e2[0] || $s2[0] > $e1[0]) || ($s1[1] < $e2[1] || $s2[1] < $e1[1])) ? false : true;
		}

		public static function getAreaFromOverlapRetangles(AxisPoint $s1, AxisPoint $e1, AxisPoint $s2, AxisPoint $e2){

			// if(!self::rectangleOverlap($s1->getPoint(), $e1->getPoint(), $s2->getPoint(), $e2->getPoint())) return 0;

			$sP1 = $s1->getPoint(); // [1,2] x1 y1
			$eP1 = $e1->getPoint(); // [3,0] x2 y2
			$sP2 = $s2->getPoint(); // [2,3] x3 y3
			$eP2 = $e2->getPoint(); // [5,1] x4 y4

			$x_overlap = max(0,
				min($eP1[0],$eP2[0]) - max($sP1[0],$sP2[0])
			);
            $y_overlap = max(0,
            	min($eP1[1],$eP2[1]) - max($sP1[1],$sP2[1])
            );
			// pr($sP1,$eP1,$sP2,$eP2, $x_overlap, $y_overlap);

			return $x_overlap * $y_overlap;
		}
	}