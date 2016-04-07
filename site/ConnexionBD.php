<?php 

	try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=c0bdfinal', 'root', '',$pdo_options);
	}
	catch (Exception $e)
	{
	die('Base de donnee Indisponible: ' . $e->getMessage());
	}

?>