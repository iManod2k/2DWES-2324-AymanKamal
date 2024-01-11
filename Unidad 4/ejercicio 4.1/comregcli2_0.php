<?php
	session_start();
?>

<html>
	<body>

<form name="almacen" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

<label for="nombre_texto">Nombre</label>
<input type="text" name="nombre" value="Ayman">
<br>
<label for="apellido_texto">Apellidos</label>
<input type="text" name="apellido" value="Kamal Boulhand">
<br>
<input type="submit" name="enviar">
</form>




	<?php

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			$_SESSION['user'] = $_POST['nombre'];

			$apellido_reves = explode(" ", trim($_POST['apellido']) );
			$apellido_reves = implode($apellido_reves);

			$_SESSION['password'] = $apellido_reves;



			print_r($apellido_reves);
		}

		echo $_COOKIE['PHPSESSID'];

	?>
	</body>
</html>