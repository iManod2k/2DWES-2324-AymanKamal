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
	
		$filas = 10;
		$columnas = 4;
		
		$nota_min = 0;
		$nota_max = 10;
		
		$arrayMulti = array([],[]);
		
		$numero_maximo = array();
		$numero_maximo = array_fill(0,$filas,$nota_min); // Relleno el array desde 0 hasta nº de filas con 0s
		$numero_minimo= array();
		$numero_minimo = array_fill(0,$filas,$nota_max); // Relleno el array desde 0 hasta nº de filas con 0s
		$numero_promedio = array();
		$numero_promedio = array_fill(0,$filas,0); // Relleno el array desde 0 hasta nº de filas con 0s
		
		
		// Por cada fila, recorro X columnas
		for($f = 0; $f < $filas; $f++){
			for($c = 0; $c < $columnas; $c++){
					
					// Genero un numero y lo reviso
					$numero_rand = rand($nota_min,$nota_max);
					if($numero_maximo[$f] < $numero_rand){
						$numero_maximo[$f] = $numero_rand;
					}
					
					if($numero_minimo[$f] > $numero_rand) {
						$numero_minimo[$f] = $numero_rand;
					}
					
				$numero_promedio[$f] += $numero_rand;
					
				$arrayMulti[$f][$c] = $numero_rand;
				echo $arrayMulti[$f][$c]." ";
			}
			echo "</br>";	
		}
		
		echo "</br>";
		echo "</br>";
		echo "Notas Maximas -> ";
		print_r($numero_maximo);
		
		echo "</br>";
		echo "</br>";
		echo "Notas Minimas -> ";
		print_r($numero_minimo);
		
		
		
		
		
		
		
		
		$index_alumno_minimo;
		$index_alumno_maximo;
		// Por cada columna, recorro X filas
		
		echo "</br>";
		echo "</br>";
		
		for($cc = 0; $cc < $columnas; $cc++){
			for($ff = 0; $ff < $filas; $ff++){
				echo $arrayMulti[$ff][$cc]."</br>";
			}
			echo " ";
			echo "</br>";
		}
		
		
				
				
			
			
		
			
		
	?>
	
</body>
</html>

