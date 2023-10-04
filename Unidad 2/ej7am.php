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
	
		$filas = 10;
		$columnas = 4;
		
		$nota_min = 0;
		$nota_max = 10;
		
		$arrayMulti = array([],[]);
		$notas_alumnos_promedio= array();
		$notas_alumnos_promedio = array_fill(0,$filas,0); // Relleno el array desde 0 hasta nº de filas con 0s
		
		
		// Por cada fila, recorro X columnas
		for($f = 0; $f < $filas; $f++){
			for($c = 0; $c < $columnas; $c++){
					
				// Genero un numero y lo reviso
				$numero_rand = rand($nota_min,$nota_max);
				
				$notas_alumnos_promedio[$f] += $numero_rand;
					
				$arrayMulti[$f][$c] = $numero_rand;
				echo $arrayMulti[$f][$c]." ";
			}
			
			$notas_alumnos_promedio[$f] /= $columnas;
			
			echo "</br>";	
		}
		
		
		
		
		
		echo "</br>";
		echo "</br>";
		for($i=0; $i<$filas; $i++){
			echo "</br>";
			printf("El alumno ".$i." tiene una media de todas las asignaturas de: ".$notas_alumnos_promedio[$i]);
		}
		
		
		
		
		
		
		
		
		// Por cada columna, recorro X filas
		
		echo "</br>";
		echo "</br>";
		
		$asig_max;
		$asig_min;
		$nom_max;
		$nom_min;
		$n_max;
		$n_min;
		$notas_media = array();
		
		$notas_asignaturas_promedio = array();
		$notas_asignaturas_promedio = array_fill(0,$filas,0); // Relleno el array desde 0 hasta nº de filas con 0s
		
		for($cc = 0; $cc < $columnas; $cc++){
			for($ff = 0; $ff < $filas; $ff++){
					
						if($arrayMulti[$ff][$cc] > $nota_min){
							$nota_min = $arrayMulti[$ff][$cc];
							$n_max= $arrayMulti[$ff][$cc];
							$nom_max= $ff;
							$asig_max = $cc;
						}
						if($arrayMulti[$ff][$cc] < $nota_max){
							$nota_max= $arrayMulti[$ff][$cc];
							$n_min= $arrayMulti[$ff][$cc];
							$nom_min= $ff;
							$asig_min = $cc;
						}
						
						$notas_asignaturas_promedio[$cc] += $arrayMulti[$ff][$cc];
			}
			
			$notas_asignaturas_promedio[$cc] = $notas_asignaturas_promedio[$cc] / $filas;
			echo " ";
			echo "</br>";
		}
		
		
		echo "La maxima nota fue de ".$nom_max." con un ".$n_max." en la asignatura de ".$asig_max;
		echo "</br>";
		echo "La minima nota fue de ".$nom_min." con un ".$n_min." en la asignatura de ".$asig_min;		
		
		echo "</br>";
		for($i=0; $i<$columnas; $i++){
			echo "</br>";
			printf("En la asignatura ".$i." los alumnos tienen la media de ".$notas_asignaturas_promedio[$i]);
		}
			
		
			
			
		

		
		echo "</br>";
		echo "</br>";
		
		$alumno = 3; // quiero saber las notas de este
		$notas_bajo_alta = array(0,10);
		$notas_materia = array();
		
		if($alumno < $filas){
			for($ccc = 0; $ccc < $columnas; $ccc++){
				
				if($arrayMulti[$alumno][$ccc] > $notas_bajo_alta[0]){
					$notas_bajo_alta[0] = $arrayMulti[$alumno][$ccc];
					$notas_materia[0] = $ccc;
				}
				if($arrayMulti[$alumno][$ccc] < $notas_bajo_alta[1]){
					$notas_bajo_alta[1] = $arrayMulti[$alumno][$ccc];
					$notas_materia[1] = $ccc;
				}
			}
			
			echo "El alumno ".$alumno." ha sacado minimo un ".$notas_bajo_alta[0]." en ".$notas_materia[0];
			echo "</br>";
			echo "El alumno ".$alumno." ha sacado maximo un ".$notas_bajo_alta[1]." en ".$notas_materia[1];
		}
		
		echo "</br>";	
		
		
	?>
	
</body>
</html>

