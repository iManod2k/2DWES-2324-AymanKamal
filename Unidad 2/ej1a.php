<html>
<head>
	<style>
		table, td{
			border : 1px solid black;
			padding: 3px;
		}
	</style>
	<title>Practica ej1a.php</title>
</head>
<body>
	<?php
		
		// Calculo primero los primos
		$lista_numeros_impares_recogidos = primeros_20_primos();
		
		// Después Sumo desde X posición los primos que tenga atrás
		$lista_numeros_impares_suma = suma_primo_y_anteriores();
		
		print_r($lista_numeros_impares_recogidos);
		print("<br>");
		print_r($lista_numeros_impares_suma);
		print("<br>");
		
		// DIBUJAR TABLA
		dibujar_tabla();
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		function primeros_20_primos(){
			
			$lista_numeros_impares = array();
			
			for($i=1; $i<=20; $i++){	
				if($i % 2 != 0){
					array_push($lista_numeros_impares, $i);
				}
			}
			
			return $lista_numeros_impares;
		}
		
		
		function suma_primo_y_anteriores(){
			
			global $lista_numeros_impares_recogidos; // Variable ya declarada, indico que es global
			$lista_numeros_impares_resul = array();
			
			for($i=0; $i<count($lista_numeros_impares_recogidos); $i++){
				$cont = $i;
				$suma = 0;
				
				while($cont >= 0){
					$suma += $lista_numeros_impares_recogidos[$cont];
					$cont--;
				}
				array_push($lista_numeros_impares_resul, $suma);
			}
			return $lista_numeros_impares_resul;
		}
		
		
		function dibujar_tabla(){
			
			$filas = "";
			$tabla = "";
			
			global $lista_numeros_impares_suma;
			global $lista_numeros_impares_recogidos;
			
			// Se que ambos array tienen el mismo tamaño... por lo que puedo deducir la cantidad de filas
			for($i = 0; $i < count($lista_numeros_impares_suma); $i++){
				
				$celdas = "";
				$celdas .= sprintf("<td>%s</td>", $i);
				$celdas .= sprintf("<td>%s</td>", $lista_numeros_impares_recogidos[$i]);
				$celdas .= sprintf("<td>%s</td>", $lista_numeros_impares_suma[$i]);
				
				$filas .= sprintf("<tr>%s</tr>", $celdas);
				
			}
			
			
			$tabla = sprintf("<table>%s</table>", $filas);
			
			echo sprintf($tabla);
			
		}
			
	?>
	
</body>
</html>

