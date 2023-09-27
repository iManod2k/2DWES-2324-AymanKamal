<html>
<head>
	<style>
		table, td{
			border : 1px solid black;
			padding: 3px;
		}
	</style>
	<title>Practica ej3a.php</title>
</head>
<body>
	<?php
		
		// Declaro variables
		$numeros_binarios;
		$numeros_octales;
		$lista_numeros_binarios = primeros_numeros_binarios(20);
		
		dibujar_tabla();
		
		
		
		
		
		
		
		
		
		function primeros_numeros_binarios($cantidad){
			
			global $numeros_binarios;
			global $numeros_octales;
			
			for($i=1; $i<=$cantidad; $i++){
				$numeros_binarios[] = sprintf("%b", $i);
				$numeros_octales[] = sprintf("%o", $i);
			}
			
			return $numeros_binarios;
		}
		
		
		function dibujar_tabla(){
			
			$filas = "";
			$tabla = "";
			
			global $numeros_binarios;
			global $numeros_octales;
			
			// Se que ambos array tienen el mismo tamaño... por lo que puedo deducir la cantidad de filas
			for($i = 0; $i < count($numeros_binarios); $i++){
				
				$celdas = "";
				$celdas .= sprintf("<td>%s</td>", $i);
				$celdas .= sprintf("<td>%s</td>", $numeros_binarios[$i]);
				$celdas .= sprintf("<td>%s</td>", $numeros_octales[$i]);
				
				$filas .= sprintf("<tr>%s</tr>", $celdas);
				
			}
			
			$tabla = sprintf("<table>%s</table>", $filas);
			
			
			echo sprintf($tabla);
			
		}
			
	?>
	
</body>
</html>

