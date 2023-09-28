<html>
<head>
	<style>
		table, td{
			border : 1px solid black;
			padding: 3px;
		}
	</style>
	<title>Practica ej7a.php</title>
</head>
<body>
	<?php
		
		$alumnos_notas = array("Ayman" => 23, "Ivan" => 21, "Carlos" => 19, "Lin" => 20, "Manuel" => 19);
		
		
		foreach($alumnos_notas as $nombre => $edad){
			printf($nombre." tiene ".$edad." años");
			printf("</br>");
		}
		
		
		printf("</br>");
		printf("</br>");
		$notas = array_values($alumnos_notas); // Obtengo los valores para poder recorrerlos con un Indice
		printf("Segunda posicion ".$notas[1]);
		printf("</br>");
		printf("Tercera posicion ".$notas[2]);
		printf("</br>");
		printf("Ultima posicion posicion ".$notas[count($notas)-1]);
		printf("</br>");
		printf("</br>");
		
		asort($alumnos_notas, 1); // Compara los VALORES y sabe que son numericos por el 1. KSORT compara en las Keys
		print_r($alumnos_notas);
	?>
	
</body>
</html>

