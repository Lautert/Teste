<?php
	define('D', 'CONST_DIE');

	if (!function_exists('pr')) {
		function pr(...$vars){
			$die = false;
			if(count($vars) > 1){
				$last = end($vars);
				if($last === 'CONST_DIE'){
					array_pop($vars);
					$die = true;
				}
			}
			foreach ($vars as $k => $var){
				$var = (!is_bool($var)) ? $var : ($var ? "True" : "False");
				echo "\n<pre>";
				print_r($var);
				echo "</pre>\n";
			}
			if($die){
				die();
			}
		}
	}

	if (!function_exists('vr')){
		function vr(...$vars){
			$die = false;
			if(count($vars) > 1){
				$last = end($vars);
				if($last === 'CONST_DIE'){
					array_pop($vars);
					$die = true;
				}
			}
			foreach ($vars as $k => $var){
				$var = (!is_bool($var)) ? $var : ($var ? "True" : "False");
				echo "\n/*<pre>";
				var_dump($var);
				echo "</pre>*/\n";
			}
			if($die){
				die();
			}
		}
	}