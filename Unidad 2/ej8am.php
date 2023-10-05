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
		
		$matrizA = array([],[]);
		$cont = 1;
			// Relleno la matriz
			
			for($f=0; $f<$filas; $f++){
				for($c=0; $c<$columnas; $c++){
					$matrizA[$f][$c] = $cont;
					$cont++;
				}
			}
		
		$matrizB = $matrizA;
		
		
		// Realizo la suma y producto
		$suma_matrices = array([],[]);
		
		$producto_matrices = array([],[]);
		$col_producto_fijo = 0;
		echo "SUMA - MATRIZ";
		echo "</br>";
			for($f=0; $f<$filas; $f++){
				
				for($c=0; $c<$columnas; $c++){
					
					// suma
					$num_a = $matrizA[$f][$c];
					$num_b = $matrizB[$f][$c];
					
					$suma_matrices[$f][$c] = $num_a + $num_b;
					echo $suma_matrices[$f][$c]." ";
					
					
					// producto
					$operacion_producto = $matrizA[$f][$c] * $matrizB[$c][$f];
					$producto_matrices[$f][$c] = $operacion_producto;
				}
				
				echo "</br>";
			}
			
			echo "</br>";
			echo "</br>";
			
			echo "PRODUCTO - MATRIZ";
			echo "</br>";
			for($f=0; $f<$filas; $f++){
					
				for($c=0; $c<$columnas; $c++){
					
					echo $producto_matrices[$f][$c]." ";
				}
				
				echo "</br>";
			}
	?>
	
</body>
</html>


