
<html>
<body>
	<form name="form_alumnos" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	
		<label for="nombre">Nombre</label>
		<input name="nombre" type="text"></input>
		<br>
		
		<label for="apellido1">Apellido 1</label>
		<input name="apellido1" type="text"></input>
		<br>
		
		<label for="apellido2">Apellido 2</label>
		<input name="apellido2" type="text"></input>
		<br>
		
		<label for="fecha_nacimiento">Fecha de Nacimiento</label>
		<input name="fecha_nacimiento" type="text"></input>
		<br>
		
		<label for="localidad">Localidad</label>
		<input name="localidad" type="text"></input>
		<br>
		
		<input type="submit" value="Enviar">
	</form>
	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		// Si no existe el fichero, lo crea con permisos de Escritura y Lectura VACIO
		//$fichero = fopen("alumnos1.txt", "w+"); // -> SOBREESCRIBE desde el comienzo del  fichero
		$fichero = fopen("alumnos1.txt", "a+"); // -> Comeinza desde el final
		
		// MAXIMO REAL -> 156
		$nombre = str_pad($_POST['nombre'], 40, ' ', STR_PAD_RIGHT); // 1 - 40
		$apellido1 = str_pad($_POST['apellido1'], 40, ' ', STR_PAD_RIGHT); // 41 - 81
		$apellido2 = str_pad($_POST['apellido2'], 41, ' ', STR_PAD_RIGHT); // 82 - 123
		$fecha_nacimiento = str_pad($_POST['fecha_nacimiento'], 9, ' ', STR_PAD_RIGHT); // 124 - 133
		$localidad = str_pad($_POST['localidad'], 26, ' ', STR_PAD_RIGHT); // 134 - 160
		
		// Si se pasa de X tamaño, algo habremos escrito demasiado largo
		$suma_total_tamanios = strlen($nombre)+strlen($apellido1)+strlen($apellido2)+strlen($fecha_nacimiento)+strlen($localidad);
		
		if($suma_total_tamanios > 156){
			echo "Error al escribir. Limite sobrepasado";
		}else {
			echo $suma_total_tamanios;
		
			fwrite($fichero, $nombre.$apellido1.$apellido2.$fecha_nacimiento.$localidad."\n");
			
			echo $nombre;
		}
		
	}
	?>
</body>
</html>