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
		
		$array_todo_junto = [];
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
		
		
		
		// Veo cual es el mayor
		$num = 0;
		$fil = 0;
		$col = 0;
		for($f = 0; $f < $filas; $f++){
			for($c = 0; $c < $columnas; $c++){
				$num_sacado = $arrayMulti[$f][$c];
				if($num_sacado > $num){
					$num = $num_sacado;
					$fil = $f;
					$col = $c;
				}
			}
		}
		
		echo "El valor mas alto es: ".$num." en la posicion".sprintf("(%s, %s)", $fil, $col);
		
		/* OTRA SOLUCION
		// Lo unifico todo
		foreach($arrayMulti as $array){
			$array_todo_junto = array_merge($array_todo_junto, $array);
		}
		
		asort($array_todo_junto, 1);
		
		echo end($array_todo_junto);
		*/
	?>
	
</body>
</html>

