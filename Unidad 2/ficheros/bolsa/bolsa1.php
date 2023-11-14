<?php
	// Leer ficheros
	// "ibex35.txt"
	
	include "funciones_bolsa.php";
	
	$datos = leerFichero();
	print_r($datos["ACS"]);
?>