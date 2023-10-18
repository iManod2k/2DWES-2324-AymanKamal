<?php

	require "../funciones.php";
	
	
	
	$nombre = limpiar_data($_POST['nombre']);
	$apellido1 = limpiar_data($_POST['apellido1']);
	$apellido2 = limpiar_data($_POST['apellido2']);
	$email = limpiar_data($_POST['email']);
	
	$sxo = !empty($_POST['sexo']) ? $_POST['sexo'] : "";
	
	// nombre correcto
	if(verificarNombreApellidos($nombre)){	

		if($sxo == "h" || $sxo == "m"){
			if(verificarEmail($email)){
				
				
				
				echo $nombre." | ";
				echo $apellido1." | ";
				echo $apellido2." | ";
				echo $email." | ";
				echo $sxo;
				
				$txt = "data.txt";
				$fichero = fopen($txt, 'a');
				
				fwrite($fichero, $nombre."$");
				fwrite($fichero, $apellido1."$");
				fwrite($fichero, $apellido2."$");
				fwrite($fichero, $email."$");
				fwrite($fichero, $sxo."\n");
				fclose($fichero);
				echo "BIEN";
			}	
		}
			
	}
	
	
?>