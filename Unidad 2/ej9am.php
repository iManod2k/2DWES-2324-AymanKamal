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
	
		$filas = 3;
		$columnas = 6;
		
		$matriz_traspuesta = array([],[]);
		$cont = 1;
		
			// Relleno la matriz
		for($f = 0; $f < $filas; $f++){
			for($c = 0; $c < $columnas; $c++){
					
				$arrayMulti[$f][$c] = $cont;
				$matriz_traspuesta[$c][$f] = $cont;
				$cont++;
				echo $arrayMulti[$f][$c]." ";
			}
			
			echo "</br>";	
		}
		
		
		echo "</br>";	
		echo "</br>";	
		for($f = 0; $f < $columnas; $f++){
			for($c = 0; $c < $filas; $c++){
				
				echo $matriz_traspuesta[$f][$c]." ";
			}
			
			echo "</br>";	
		}
			
			
		
	?>
	
</body>
</html>


