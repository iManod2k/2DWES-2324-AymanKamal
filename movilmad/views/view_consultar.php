<?php
	
	function show_cars($coches){

		echo "<br>";
		echo "<br>";
		echo "Matricula -> ".$coches['matricula'];
		echo "<br>";
		echo "Marca -> ".$coches['marca'];
		echo "<br>";
		echo "Modelo -> ".$coches['modelo'];
		echo "<br>";
		echo "Fecha de Alquiler -> ".$coches['fecha_alquiler'];
		echo "<br>";
		echo "Fecha de Devolución -> ".$coches['fecha_devolucion'];
		echo "<br>";
		echo "Precio total -> ".$coches['preciototal'];
		echo "<br> ////////////////";
	}
?>