<?php
	session_start();
?>

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
		$_SESSION['user'] = $_POST['usuario'];
		$_SESSION['password'] = $_POST['contrasenia'];
	}

	echo "<br>";
	echo "Bienvenido señor ".$_SESSION['user']." con contraseña ".$_SESSION['password']." !";
	
	
	print_r($_SESSION); // La variable global SESSION es realmente un array.

	$_SESSION['user'] = "Berenjena";
	$_SESSION['password'] = "Macacus";

	echo "<br>";
	echo "Modifico la info:";

	print_r($_SESSION); // La variable global SESSION es realmente un array.

	echo "<br>";
	echo "Elimino por completo la sesión: ";
	
	session_unset();
	session_destroy();
	print_r($_SESSION);


?>