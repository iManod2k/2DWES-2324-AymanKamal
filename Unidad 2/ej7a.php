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
		printf(current($alumnos_notas)." Valor de la primera posicion");
		printf("</br>");
		printf(next($alumnos_notas)." Siguiente valor");
		printf("</br>");
		printf(end($alumnos_notas)." Ultimo valor del array");
		printf("</br>");
		printf("</br>");
		
		asort($alumnos_notas, 1);
		print_r($alumnos_notas); // Ordeno el array según el valor ascendente
		printf("</br>");
	?>
	
</body>
</html>

