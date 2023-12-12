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
			<input type="submit" name="enviar">
		</form>


		<?php

		include 'conexion.php';
		
			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				$conn = conexionBBDD();

				altaCliente($conn);
			}

			
			function altaCliente($conn){

				$dni = $_POST['dni_cliente'];

				if(strlen($dni) == 9){

					$numeros = substr($dni, 0, 8);
					$letra = $dni[8];


					if(is_numeric($numeros) && (strtolower($letra) <> strtoupper($letra)) ){
						echo "DNI Correcto";

						$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

						$sql_insert = "INSERT INTO cliente (nif,nombre,apellido,cp,direccion,ciudad) VALUES (:nif, :nombre, :apellido, :cp, :direccion, :ciudad);";

						$stmt_insert = $conn -> prepare($sql_insert);


						$stmt_insert -> bindParam(':nif', $dni);
						$stmt_insert -> bindParam(':nombre', $_POST['nombre']);
						$stmt_insert -> bindParam(':apellido', $_POST['apellido']);
						$stmt_insert -> bindParam(':cp', $_POST['cp']);
						$stmt_insert -> bindParam(':direccion', $_POST['direccion']);
						$stmt_insert -> bindParam(':ciudad', $_POST['ciudad']);

						try{
							$stmt_insert -> execute();
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
			
		?>
	</body>
</html>