
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
		$fichero = fopen("alumnos2.txt", "a+"); // -> Comeinza desde el final
		
		// MAXIMO REAL -> 156
		$nombre = $_POST['nombre']."##";
		$apellido1 = $_POST['apellido1']."##";
		$apellido2 = $_POST['apellido2']."##";
		$fecha_nacimiento = $_POST['fecha_nacimiento']."##";
		$localidad = $_POST['localidad'];

			fwrite($fichero, $nombre.$apellido1.$apellido2.$fecha_nacimiento.$localidad."\n");
			
			echo $nombre;
		
	}
	?>
</body>
</html>