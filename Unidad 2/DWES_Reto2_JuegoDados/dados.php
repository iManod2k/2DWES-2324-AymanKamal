<html>
	<head>
		<style>
			table, td, tr{
				border: solid 1px;
			}
			img{
				height: 75px;
			}
		</style>
	</head>
	<body>
		
		<?php
	
			$jugador1 = $_POST['jug1'];
			$jugador2 = $_POST['jug2'];
			$jugador3 = $_POST['jug3'];
			$jugador4 = $_POST['jug4'];
			
			$num_dados  = $_POST['numdados'];
			//min 1 - max 10


			if(
				(strlen($jugador1) == 0 || strlen($jugador2) == 0 || strlen($jugador3) == 0 || strlen($jugador4) == 0 ) ||
				(is_numeric($num_dados) == false)
			){
				die("Error: Nombre vacío o Nº de datos no es dígito");
				// El Script se detiene a partir de aquí
			}else {

				$tiradas = intval($num_dados);
				try{
					comprobarNumeroTiradas($tiradas);
					// Si sucede un error, va al catch > die y se detiene el Script. Sino, continúa abajo

				}catch(Exception $e){
					die("Error: Numero de tiradas no válidas (min 1 máx 10)");
				};
				
				$jugadoresPuntuacion = array();
				generarTiradaTabla($jugador1,$jugador2,$jugador3,$jugador4, $num_dados, $jugadoresPuntuacion);

				$jugadoresPuntuacion_Suma = array();
				sumaValoresDados($jugadoresPuntuacion, $jugadoresPuntuacion_Suma, $num_dados);

				comprobarGanadores($jugadoresPuntuacion_Suma);

				grabarInformacion($jugadoresPuntuacion_Suma, $jugadoresPuntuacion);

			}

			










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
					// Si en las X casillas ha encontrado 1 único número... quiere decir que es el mismo en las 4.
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
	</body>
</html>
