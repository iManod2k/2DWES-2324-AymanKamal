<?php
	if( isset($_COOKIE['user']) ){
		// Existe una sesión. Voy al LOGIN
		header("Location: comprocli.php ");
	}else{
		// Si no existe, permanece en la página login
	}
	
?>

<html>
	<head></head>
	<body>

		<form name="almacen" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

			<label for="user">Usuario: </label>
			<input type="text" name="user">
			<br>
			<label for="password">Contraseña: </label>
			<input type="text" name="password">
			<br>

			<input type="submit" name="enviar_login" value="Enviar">
			<input type="submit" name="enviar_reg" value="REGISTRAR">
		</form>


		<?php

		include '../../Unidad 3/webcompras/conexion.php';
		
			if(isset($_POST['enviar_reg'])){ // Si se pulsa el botón REGISTRAR...
				header("Location: comregcli.php");
			}

			if(isset($_POST['enviar_login'])){ // Si se pulsa el botón LOG IN...
				$conn = conexionBBDD();

				verificar_usuario_bbdd($conn);
			}




			
			function verificar_usuario_bbdd($conn){

				$user = $_POST['user'];
				$password = $_POST['password'];

				try{

					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$sql = "SELECT NOMBRE, NIF, PASSWORD FROM cliente WHERE NOMBRE=:user AND PASSWORD=:password;";

					$stmt = $conn -> prepare($sql);

					$stmt -> bindParam(':user', $user);
					$stmt -> bindParam(':password', $password);

					$stmt -> execute();

					$stmt -> setFetchMode(PDO::FETCH_ASSOC);

					$resul = $stmt -> fetchAll();

					

					if( count(array_values($resul)) == 1 ){
						
						$ttl = time() + 60;
						setcookie("user", $user, $ttl, "/"); // Creo la cookie
						setcookie("nif", $resul[0]['NIF'], $ttl, "/"); // Creo la cookie
						setcookie("ttl", $ttl, $ttl, "/"); // Creo la cookie

						header("Location: comprocli.php");
					}elseif(count(array_values($resul)) > 1) {
						echo "Mas de un usuario con la misma información de login !!!!!";
					}else {
						echo "Usuario no encontrado";
					}

					$conn = null;
				}catch(PDOException $e){

					echo "ERROR";
					echo "<br>";
					echo $e;
				}


			}


		?>
	</body>
</html>