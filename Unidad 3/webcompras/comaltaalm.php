<html>
	<head></head>
	<body>

		<form name="almacen" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

			<label for="localidad_almacen">Localidad del Almacen</label>
			<input type="text" name="localidad_almacen">
			<br>
			<input type="submit" name="enviar">
		</form>


		<?php
		
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$conn = conexionBBDD();

				altaAlmacenes($conn);
			}

			function conexionBBDD(){
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "comprasweb";

				$conn = new PDO("mysql:host=$servername;dbname=".$dbname,$username,$password);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				echo "Conectado";
				return $conn;
			}

			
			function altaAlmacenes($conn){
				
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				$sql = "SELECT MAX(NUM_ALMACEN) as num_almacen FROM almacen";

				$stmt = $conn -> prepare($sql);
				$stmt -> execute();

				$stmt -> setFetchMode(PDO::FETCH_ASSOC);

				$resul = $stmt -> fetchAll();

				$sql_insert = "INSERT INTO almacen (num_almacen, localidad) VALUES (:num_almacen, :localidad);";

				$stmt_insert = $conn -> prepare($sql_insert);
				

				if(strlen($resul[0]['num_almacen']) == 0 ){
					echo "ta vacio";
					
					$codigo = "1";
					$stmt_insert -> bindParam(':num_almacen', $codigo);

					echo "Inserción satisf";
				}else {
					echo "ta lleno";

					$codigo = intval($resul[0]['num_almacen'])+1;

					$stmt_insert -> bindParam(':num_almacen', $codigo);
				}

				$stmt_insert -> bindParam(':localidad', $_POST['localidad_almacen']);
				$stmt_insert -> execute();
				
			}
			
		?>
	</body>
</html>