<?php
	
	const nombre_archivo = "ibex35.txt";
	$cabeceras;
	
	function leerFichero(){
		
		$archivo = fopen(nombre_archivo, "r");
		
		global $cabeceras; // Declaro que la variable sea GLOBAL para acceder a ella
		// desde otros lugares
		$cabeceras = fgets($archivo, 1000);
		$cabeceras = preg_split("/\\s{2,}/",$cabeceras);
		unset($cabeceras[10]);
		unset($cabeceras[0]);
		$cabeceras = array_values($cabeceras);
		
		
		$datos;
		do{
			$info = fgets($archivo, 1000);
			$info = preg_split("/\\s{2,}/",$info); // Recojo y parto la información
			
			$nombre = $info[0];
			unset($info[0]); // Extraigo el nombre de la primera posicion y la elimino
			unset($info[10]); // Elimino la última posición porque está vacía
			$info = array_values($info);	// Re-añado los valores al mismo array
			$datos[$nombre] = $info;
			
		}while(!feof($archivo)); // Mientras que el puntero no haya llegado al final del Archivo
		
		fclose($archivo);
		
		
		return $datos;
	}
	
	
	function solicitarInfoEmpresa($nombre){
		$datos = leerFichero();
		
		return array_key_exists($nombre, $datos)?$datos[$nombre]:"No encontrado";
	}
	
	
	function solicitarInfoSelect(){
		
		$datos = leerFichero();
		
		// que NO me interesan: 2,3,4,7,8,9.
		// Empiezo por 1 menos porque en LeerFichero elimino la primera posición, el nombre.
		// También elimino la última (que no tiene nada), pero no es importante esa
		
		forEach(array_keys($datos) as $key){
			unset($datos[$key][1]);
			unset($datos[$key][2]);
			unset($datos[$key][3]);
			unset($datos[$key][6]);
			unset($datos[$key][7]);
			unset($datos[$key][8]);
			
			$datos[$key] = array_values($datos[$key]);
			
		}
		
		return $datos;
		
	}
?>