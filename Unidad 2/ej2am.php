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
		$cont = 1;
		
		$arrayMulti = array([],[]);
		$suma_por_filas = 0;
		$suma_por_columnas = 0;
		
		// Creo la tabla con los numeros de nuevo
		for($f = 0; $f < $filas; $f++){
			for($c = 0; $c < $columnas; $c++){
				
				$operacion = $cont * 2;
				$arrayMulti[$f][$c] = $operacion;
				$cont++;
				
				echo $operacion." ";
			}
			echo "</br>";
		}
		
		
		echo "</br>";
		echo "</br>";
		echo "</br>";
		
		// Calculo por filas y columnas
		$resul_suma_por_filas = "";
		$resul_suma_por_columnas = "";
		for($f = 0; $f < $filas; $f++){
			
			for($c = 0; $c < $columnas; $c++){
				$suma_por_filas += $arrayMulti[$f][$c];
				$suma_por_columnas += $arrayMulti[$c][$f];
			}
			
			$resul_suma_por_filas .= $suma_por_filas."\n";
			$resul_suma_por_columnas .= $suma_por_columnas." ";
			
			$suma_por_filas = 0;
			$suma_por_columnas = 0;
		}
		
		echo "SUMA POR FILAS: ".$resul_suma_por_filas;
		echo "</br>";
		echo "SUMA POR COLUMNAS: ".$resul_suma_por_columnas;
		
		
		
	?>
	
</body>
</html>

