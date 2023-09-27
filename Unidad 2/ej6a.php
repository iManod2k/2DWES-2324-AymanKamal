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
		
		$asignaturas_unidas;
		
		
		$asignaturas1 = array("Base de Datos", "Entornos Desarrollo", "Programación");
		$asignaturas2 = array("Sistemas Informáticos","FOL","Mecanizado");
		$asignaturas3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");
		
		
		echo "</br>";
		echo "</br>";
		unir_asignaturas_Merge(); // Unifica los arrays en 1 solo. Va juntandose desde el final hacia el anterior repetidamente
		
		
		/*
			Puedo eliminar el elemento con 2 formas:
				* ARRAY_SEARCH(ELEMENTO, ARRAY) ... USNET(ARRAY[INDEX]): borra especificamente el index
				con el valor (previamente facilitado)
				*  $ARRAY = ARRAY_DIFF($ARRAY, $ARRAY_CON_OBJETIVOS): otorga la diferencia del array comparandolo con el otorgado,
				haciendo comparaciones
		*/
		
		//$asignaturas_unidas = array_diff($asignaturas_unidas, ["Mecanizado"]); // Otra forma de hacerlo. 
		$index = array_search("Mecanizado", $asignaturas_unidas);
		unset($asignaturas_unidas[$index]); // Busca la diferencia entre ambos arrays. Devuelve la diferencia
		echo "</br>";
		echo "</br>";
		printf ("MECANIZADO eliminado");
		echo "</br>";
		print_r($asignaturas_unidas);
		echo "</br>";
		print($asignaturas_unidas[5]);
		echo "</br>";
		echo "</br>";
		echo "* Si sale error en el printf del index, es que el elemento ya no existe";
		
		
		
		
		function unir_asignaturas_Merge(){
			global $asignaturas_unidas;
			global $asignaturas1;
			global $asignaturas2;
			global $asignaturas3;
			
			$asignaturas_unidas = array_merge($asignaturas1, $asignaturas2, $asignaturas3);
			print_r($asignaturas_unidas);
			
		}
			
	?>
	
</body>
</html>

