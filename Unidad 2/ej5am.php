<html>
<head>
	<style>
		table, td{
			border : 1px solid black;
			padding: 3px;
		}
	</style>
	<title>Practica ej2am.php</title>
</head>
<body>
	<?php
	
		$filas = 5;
		$columnas = 3;
		
		$arrayMulti = array([],[]);
		
		
		// Relleno el array Bidimensional con información de NUMEROS
		for($f = 0; $f < $filas; $f++){
			for($c = 0; $c < $columnas; $c++){
				$arrayMulti[$f][$c] = $f+$c;
				echo $arrayMulti[$f][$c]." ";
			}
			echo "</br>";
		}
		
	?>
	
</body>
</html>

