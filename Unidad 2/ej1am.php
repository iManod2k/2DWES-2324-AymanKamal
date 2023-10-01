<html>
<head>
	<style>
		table, td{
			border : 1px solid black;
			padding: 3px;
		}
	</style>
	<title>Practica ej1am.php</title>
</head>
<body>
	<?php
	
		
		$filas = 3;
		$columnas = 3;
		$cont = 1;
		
		$arrayMulti = array([],[]);
		
		for($f = 0; $f < $filas; $f++){
			for($c = 0; $c < $columnas; $c++){
				
				$operacion = $cont * 2;
				$arrayMulti[$f][$c] = $operacion;
				$cont++;
				
				echo $operacion." ";
			}
			echo "</br>";
		}
		
		
	?>
	
</body>
</html>

