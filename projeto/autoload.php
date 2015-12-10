<?php

function __autoload($classe){
	$dirs = array("");
	foreach ($dirs  as $pasta) {
		if (file_exists($pasta.$classe.".class.php"))
		require_once $pasta.$classe.".class.php";
	}
	
}