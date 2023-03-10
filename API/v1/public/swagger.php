<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);

	require("../vendor/autoload.php");
	$openapi = \OpenApi\Generator::scan([__DIR__]);
	echo $openapi->toYaml();
?>