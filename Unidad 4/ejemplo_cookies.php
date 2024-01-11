
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Prueba</title>
</head>
<body>

	<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
		<label>Usuario</label>
		<input type="text" name="usuario" value="Ayman">

		<label>Contraseña</label>
		<input type="password" name="contrasenia" value="Asdf123">

		<input type="submit">
	</form>
	
</body>
</html>


<?php



	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$usuario = $_POST['usuario'];
		$contrasenia = $_POST['contrasenia'];
		

		if(isset($_COOKIE['usuario']) || isset($_COOKIE['contrasenia'])){

			echo "Existen cookies de USUARIO y CONTRASENIA. Borrandolos";
			echo "<br>";
			setcookie("usuario", "", time() - 3600, "/");
			setcookie("contrasenia", "", time() - 3600, "/"); // Elimino las Cookies
		}else {
			echo "Cookies no establecidas.";
			echo "<br>";
			echo "Creando Cookies (Refresce la pestaña)";
			setcookie("usuario", $usuario, time() + (86400 * 30), "/");
			setcookie("contrasenia", $contrasenia, time() + (86400 * 30), "/"); // Creo las Cookies. Duran 1 mes
		}

		echo $_COOKIE['usuario'];
		echo $_COOKIE['contrasenia'];
	}
?>