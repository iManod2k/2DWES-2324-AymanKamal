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

		require "dados_funciones.php";
	
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

			










		?>
	</body>
</html>
