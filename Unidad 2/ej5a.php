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
		
		$asignaturas_unidas; // Se vacía dentro de cada función
		
		$asignaturas1 = array("Base de Datos", "Entornos Desarrollo", "Programación");
		$asignaturas2 = array("Sistemas Informáticos","FOL","Mecanizado");
		$asignaturas3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");
		//dibujar_tabla();
		
		unir_asignaturas_sinFunciones();
		echo "</br>";
		echo "</br>";
		unir_asignaturas_Merge(); // Unifica los arrays en 1 solo. Va juntandose desde el final hacia el anterior repetidamente
		echo "</br>";
		echo "</br>";
		unir_asignaturas_Push(); // Inserta los elementos TAL CUAL al final del primer array
		
		
		
		
		
		
		
		
		function unir_asignaturas_Push(){
			global $asignaturas_unidas;
			global $asignaturas1;
			global $asignaturas2;
			global $asignaturas3;
			
			// Inserta los siguientes arrays en la ultima posicion del primero. No los valores, sino el array TAL CUAL
			array_push($asignaturas_unidas, $asignaturas1, $asignaturas2, $asignaturas3 );
			
			//print_r($asignaturas_unidas);
			
			foreach($asignaturas_unidas as $array){ //
				foreach($array as $valor){
				
					print_r($valor);
				}
			}
			
			// Vacío el array para usarlo de nuevo
			$asignaturas_unidas = [];
		}
		
		
		function unir_asignaturas_Merge(){
			global $asignaturas_unidas;
			global $asignaturas1;
			global $asignaturas2;
			global $asignaturas3;
			
			$asignaturas_unidas = array_merge($asignaturas1, $asignaturas2, $asignaturas3);
			print_r($asignaturas_unidas);
			
			// Vacío el array para usarlo de nuevo
			$asignaturas_unidas = [];
		}
		
		
		function unir_asignaturas_sinFunciones(){
			
			global $asignaturas_unidas;
			global $asignaturas1;
			global $asignaturas2;
			global $asignaturas3;
			
			$tamanioMax = count($asignaturas1) + count($asignaturas2) + count($asignaturas3);
			
			$cont = 0;
			
			
			while($cont < $tamanioMax){
				
				if($cont < count($asignaturas1)){
					$asignaturas_unidas[] = $asignaturas1[$cont];
				}
				if($cont < count($asignaturas2)){
					$asignaturas_unidas[] = $asignaturas2[$cont];
				}
				if($cont < count($asignaturas3)){
					$asignaturas_unidas[] = $asignaturas3[$cont];
				}
				
				$cont++;
			}
			
			print_r($asignaturas_unidas);
			
			// Vacío el array para usarlo de nuevo
			$asignaturas_unidas = [];
		}
			
	?>
	
</body>
</html>

