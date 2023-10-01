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
		$columnas = 5;
		
		$arrayMulti = array([],[]);
		$numeros = array(2, 4, 6, 9, 7, 8, 10, 12, 1, 12, 14, 16, 88, 3, 15);
		
		$numeros_en_fila = "";
		$numeros_en_columna = "";
		
		// Relleno el array Bidimensional con información de NUMEROS
		$cont = 0;
		for($f = 0; $f < $filas; $f++){
			for($c = 0; $c < $columnas; $c++){
				$arrayMulti[$f][$c] = $numeros[$cont];
				$cont++;
				
			}
		}
		
		
		$suma_por_filas = "";
		$suma_por_columnas = "";
		
		for($f = 0; $f < $filas; $f++){
			//FILA
			for($c = 0; $c < $columnas; $c++){
				$suma_por_filas .= "(".$f.",".$c.") = ".$arrayMulti[$f][$c];
			}
		}
		
		
		for($f = 0; $f < $columnas; $f++){
			//COLUMNA
			$cont_columna_abajo = 0;
			while($cont_columna_abajo < $filas){
				$suma_por_columnas .= "(".$cont_columna_abajo.",".$f.")".$arrayMulti[$cont_columna_abajo][$f]."</br>";
				$cont_columna_abajo++;
			}
		}
		
		//$suma_por_columnas .= "(".$c.",".$f.")".$arrayMulti[$f][$f];;
		
		echo $suma_por_filas;
		echo "</br>";
		echo $suma_por_columnas;
		
	?>
	
</body>
</html>

