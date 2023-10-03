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
		$columnas = 3;
		
		$arrayMulti = array([],[]);
		
		$numero_maximo = [];
		$numero_maximo = array_fill(0,$filas,0); // Relleno el array desde 0 hasta nº de filas con 0s
		$numero_promedio = [];
		$numero_promedio = array_fill(0,$filas,0); // Relleno el array desde 0 hasta nº de filas con 0s
		
		
		for($f = 0; $f < $filas; $f++){
			for($c = 0; $c < $columnas; $c++){
					
					// Genero un numero y lo reviso
					$numero_rand = rand(1,10);
					if($numero_maximo[$f] < $numero_rand){
						$numero_maximo[$f] = $numero_rand;
					}
					
					$numero_promedio[$f] += $numero_rand;
					
				$arrayMulti[$f][$c] = $numero_rand;
				echo $arrayMulti[$f][$c]." ";
			}
			
			$numero_promedio[$f] = $numero_promedio[$f] / $filas;
			echo "</br>";
		}
		
		echo "</br>";
		
		print_r($numero_maximo);
		echo "</br>";
		print_r($numero_promedio);
	?>
	
</body>
</html>

