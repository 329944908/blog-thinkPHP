<?php
	function Lu($name){
		include "./Application/Home/library/{$name}.class.php";
			$lib = new $name();
			return $lib; 
	}