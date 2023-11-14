<?php
	
	$jugador1 = $_POST['jug1'];
	$jugador2 = $_POST['jug2'];
	$jugador3 = $_POST['jug3'];
	$jugador4 = $_POST['jug4'];
	
	$num_dados  = $_POST['numdados']; //min 1 - max 10
	
	if(strlen($jugador1) == 0 || strlen($jugador2) == 0 || strlen($jugador3) == 0 || strlen($jugador4) == 0 || !is_numeric($num_dados)){
		//echo "ERROR";
		die("Faltan nombres de jugadores o el formato del número es incorrecto");
	}else {
		
		$num_dados = intval($num_dados);
		$suma_numeros = array($jugador1 => 0,$jugador2 => 0,$jugador3 => 0,$jugador4 => 0);
		
			if($num_dados > 0 && $num_dados <=10){
				
				$filas="";
				for($fila=0; $fila < 4; $fila++){
					
					$nombre;
					
					switch($fila){
						case 0 : $nombre = $jugador1; break;
						case 1 : $nombre = $jugador2; break;
						case 2 : $nombre = $jugador3; break;
						case 3 : $nombre = $jugador4; break;
					}
					
					$columnas="";
					$repeticiones = 1; // cuando se tiren minimo 2 dados y tenga los numeros
										// iguales, tiene 100 puntos
					$numero_aux=0;
					for($columna=0; $columna <= $num_dados; $columna++){
						
						if($columna == 0){
							$columnas .= sprintf("<td style=\"border: solid 1px;\">%s</td>", $nombre);
						}else {
							$numero = rand(1,6);
							$columnas .= sprintf("<td style=\"border: solid 1px;\"><img src=\"images/%s.png\" style=\"height:75px;\"/></td>", $numero); 
							
							if($num_dados >= 2){
								if($numero <> $numero_aux){
									$numero_aux = $numero;
								}else {
									$repeticiones++;
								}
							}
							
							if($repeticiones == $num_dados){
								$suma_numeros[$nombre] = 100;
							}else {
								$suma_numeros[$nombre] += $numero;
							}
							
						}
					}
					
					$filas .= sprintf("<tr>%s<tr>", $columnas);
							
				}
				
				echo sprintf("<table style=\"border: solid 1px;\">%s</table>", $filas);
				
				mostrarPuntuacion($suma_numeros);
				comprobarGanadores($suma_numeros);
		}else {
			throw new Exception("Número no válido");
		}
		
	}
	
	
	
	
	function mostrarPuntuacion($suma_numeros){
		
		forEach($suma_numeros as $key => $value){
			echo $key." ha sacado un ".$value;
			echo "<br>";
		}
		
		
		echo "<br>";
		echo "<br>";
		
	}
	
	function comprobarGanadores($suma_numeros){
		
		$numero_maximo = max(array_values($suma_numeros));
		$ganadores = array_keys($suma_numeros, $numero_maximo);
		
		forEach($ganadores as $indice => $key){
			echo "<p>GANADOR: ".$key."</p>";
		}
		echo "Numero de ganadores: ".count($ganadores);
	}
?>