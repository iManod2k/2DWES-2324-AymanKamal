<html>
<head>
	<style>
		table, td{
			border : 1px solid black;
			padding: 3px;
		}
	</style>
	<title>Practica ej8a.php</title>
</head>
<body>
	<?php
		
		$alumnos_notas_bbdd = array("Ayman" => 7, "Ivan" => 8, "Carlos" => 6, "Lin" => 5, "Manuel" => 10);
		
		asort($alumnos_notas_bbdd, 1);
		
		printf("Nota mas alta: ".array_key_last($alumnos_notas_bbdd));
		printf("</br>");
		printf("Nota mas alta: ".array_key_first($alumnos_notas_bbdd));
		
		$media = 0;
		foreach(array_values($alumnos_notas_bbdd) as $notas){
			$media += $notas;
		}
		
		$media /= count($alumnos_notas_bbdd);
		printf("</br>");
		printf($media." de media");
	?>
	
</body>
</html>

