<html>
	<head></head>
	<body>

		<form name="almacen" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

			<label for="dni_cliente">DNI del Cliente</label>
			<input type="text" name="dni_cliente" value="06602578Z">
			<br>
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" value="Jose">
			<br>
			<label for="apellido">Apellido</label>
			<input type="text" name="apellido" value="Juanjez">
			<br>
			<label for="cp">Codigo Postal</label>
			<input type="text" name="cp" value="288047">
			<br>
			<label for="direccion">Direccion</label>
			<input type="text" name="direccion" value="Calle de la Magdalena">
			<br>
			<label for="ciudad">Ciudad</label>
			<input type="text" name="ciudad" value="Madriz">
			<br>
			<label for="password">Contraseña</label>
			<input type="password" name="password" value="">
			<br>
			<input type="submit" name="enviar_reg" value="Enviar">
			<input type="submit" name="enviar_login" value="LOGIN">
		</form>


		<?php

		include '../../Unidad 3/webcompras/conexion.php';
		

		if(isset($_POST['enviar_reg'])){ // Si se pulsa el botón REGISTRAR...
			$conn = conexionBBDD();

			altaCliente($conn);
		}

		if(isset($_POST['enviar_login'])){ // Si se pulsa el botón LOG IN...
			header("Location: comlogincli.php");
		}
		/*
			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				$conn = conexionBBDD();

				altaCliente($conn);
			}
		*/
			
			function altaCliente($conn){

				$dni = $_POST['dni_cliente'];

				if(strlen($dni) == 9){

					$numeros = substr($dni, 0, 8);
					$letra = $dni[8];


					if(is_numeric($numeros) && (strtolower($letra) <> strtoupper($letra)) ){
						echo "DNI Correcto";

						$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

						$sql_insert = "INSERT INTO cliente (nif,nombre,apellido,cp,direccion,ciudad, password) VALUES (:nif, :nombre, :apellido, :cp, :direccion, :ciudad, :password);";

						$stmt_insert = $conn -> prepare($sql_insert);


						$stmt_insert -> bindParam(':nif', $dni);
						$stmt_insert -> bindParam(':nombre', $_POST['nombre']);
						$stmt_insert -> bindParam(':apellido', $_POST['apellido']);
						$stmt_insert -> bindParam(':cp', $_POST['cp']);
						$stmt_insert -> bindParam(':direccion', $_POST['direccion']);
						$stmt_insert -> bindParam(':ciudad', $_POST['ciudad']);

							$password = trim($_POST['password']);

							if(strlen($password) == 0){
								// Si la contraseña está en blanco, uso el apellido al revés
								$password = implode(array_reverse(str_split(strtolower($_POST['apellido']), 1)));
							}

						$stmt_insert -> bindParam(':password', $password);


						try{
							$stmt_insert -> execute();

							registro_login($_POST['nombre']);

						}catch(PDOException $Exception){

							if($Exception -> getCode() === "23000"){
								echo "Error ! DNI Duplicado";
							}else {
								echo "Error diferente...";
							}
						}

					}else {
						echo "DNI MAL";
					}
				}

			}





			function registro_login($user){
				// Sesión iniciada
				setcookie("user", "", time() - 3600, "/"); 
				setcookie("nif", "", time() - 3600, "/"); // Creo la cookie
				setcookie("ttl", $ttl, time() - 3600, "/"); // Para evitar futuros problemas con las cookies, elimino posibles restos de LOG INs anteriores
				$ttl = time() + 60;
				setcookie("user", $user, $ttl, "/"); // Creo la cookie
				setcookie("nif", $_POST['dni_cliente'], $ttl, "/"); // Creo la cookie
				setcookie("ttl", $ttl, $ttl, "/"); // Creo la cookie

				header("Location: comprocli.php ");
			}
			
		?>
	</body>
</html>