<?php
		function generarTiradaTabla($jugador1,$jugador2,$jugador3,$jugador4, $num_dados, &$jugadoresPuntuacion){
			
			$tabla = "";
			$filas = "";
			for($j=0; $j<4; $j++){ // Por cada jugador (4 máximo)
				
				$columnas = "";
				switch($j){
					case 0 : 
					$columnas .= sprintf("<td>%s</td>", $jugador1);break;// Lin

					case 1 : 
					$columnas .= sprintf("<td>%s</td>", $jugador2);break;// Ayman

					case 2 : 
					$columnas .= sprintf("<td>%s</td>", $jugador3);break;// Ivan

					case 3 : 
					$columnas .= sprintf("<td>%s</td>", $jugador4);break;// Carlos

					default: break;
				}

				for($i=0; $i<$num_dados; $i++){	// Vamos de índice a índice rellenando una tirada de J jugador
					

					$numero_random = rand(1,6);
					// $numero_random = 5; // PRUEBAS
					switch($j){
						case 0 : 
						$jugadoresPuntuacion[$jugador1][$i] = $numero_random;
						$columnas .= sprintf("<td><img src=\"images/%s.png\"></img></td>", $numero_random);
						break;
						// Lin

						case 1 : 
						$jugadoresPuntuacion[$jugador2][$i] = $numero_random;
						$columnas .= sprintf("<td><img src=\"images/%s.png\"></img></td>", $numero_random);
						break;
						// Ayman

						case 2 : 
						$jugadoresPuntuacion[$jugador3][$i] = $numero_random;
						$columnas .= sprintf("<td><img src=\"images/%s.png\"></img></td>", $numero_random);
						break;
						// Ivan

						case 3 : 
						$jugadoresPuntuacion[$jugador4][$i] = $numero_random;
						$columnas .= sprintf("<td><img src=\"images/%s.png\"></img></td>", $numero_random);
						break;
						// Carlos

						default: break;
					}

				}
				$filas .= "<tr>".$columnas."</tr>";
			}


			$tabla .= "<table>".$filas."</table>";
			echo $tabla;
		}


		function comprobarNumeroTiradas($tiradas){

			if($tiradas < 1 || $tiradas > 10){
				throw new Exception("Error: Se ha pasado del límite de tiradas");		
			}

		}


		function sumaValoresDados($jugadoresPuntuacion, &$jugadoresPuntuacion_Suma, $num_dados){

			echo "<br>";
			forEach(array_keys($jugadoresPuntuacion) as $keys){
				
				$total_puntos = array_sum($jugadoresPuntuacion[$keys]);
				$jugadoresPuntuacion_Suma[$keys] = $total_puntos;

				if($num_dados >= 2){
					$numeros_repetidos = count(array_count_values($jugadoresPuntuacion[$keys]));
					// Si en las X casillas ha encontrado 1 único número... quiere decir que es el mismo en todas las columnas.
					// Lo que quiere decir que se repite X (máximo) de veces
					if($numeros_repetidos == 1){
						$total_puntos += 100;
						$jugadoresPuntuacion_Suma[$keys] = $total_puntos;
					}
				}

				echo $keys." = ".$total_puntos;
				echo "<br>";
			}

		}


		function comprobarGanadores(&$jugadoresPuntuacion_Suma){

			echo "<br>";
			$cont_ganadores = 0;
			$valor_maximo = max(array_values($jugadoresPuntuacion_Suma));			

			forEach($jugadoresPuntuacion_Suma as $key => $valor ){
				if($valor_maximo == $valor){
					$cont_ganadores++;
					echo $key." is the winneeer !";
					echo "<br>";
				}
			}

			asort($jugadoresPuntuacion_Suma, 1); // 1 te lo ordena DESCENDENTE según número
			$jugadoresPuntuacion_Suma = array_reverse($jugadoresPuntuacion_Suma);
		}


		function grabarInformacion($jugadoresPuntuacion_Suma, $jugadoresPuntuacion){

			$ubicacion = "puntuacion_dados.txt";
			$archivo = fopen($ubicacion, "a+"); // w+ Sobreescribe, a+ Añade

			$texto = "";
			forEach($jugadoresPuntuacion_Suma as $keys => $value){
				// fwrite($archivo, $keys#);
				 $texto .= $keys."#".implode("#",$jugadoresPuntuacion[$keys])."#".$value."\n";
			}

			$texto.="\n\n";

			fwrite($archivo, $texto);
			
			echo "<br>Puntuación guardada en fichero...";
			fclose($archivo);
		}
?>
