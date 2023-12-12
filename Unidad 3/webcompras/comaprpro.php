<html>
	<head></head>
	<body>

		<form name="almacen" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

			<label for="cantidad_producto">Cantidad Producto</label>
			<input type="number" name="cantidad_producto">
			<br>
			<label for="id_producto">ID Del Producto</label>
			<select name="id_producto">
				<?php

					include 'conexion.php';

					$conn = conexionBBDD();

					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$sql = "SELECT Nombre, id_producto FROM producto";

					$stmt = $conn -> prepare($sql);
					$stmt -> execute();

					$stmt -> setFetchMode(PDO::FETCH_ASSOC);

					$resul = $stmt -> fetchAll();


					foreach (array_values($resul) as $value) {
						printf("<option value=\"%s\">%s</option>",$value['id_producto'],$value['Nombre']);
					}

				?>
			</select>
			<br>
			<label for="num_almacen">Numero de Almacen</label>
			<select name="num_almacen">
				<?php

					// $conn = conexionBBDD();

					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$sql = "SELECT num_almacen, localidad FROM almacen";

					$stmt = $conn -> prepare($sql);
					$stmt -> execute();

					$stmt -> setFetchMode(PDO::FETCH_ASSOC);

					$resul = $stmt -> fetchAll();


					foreach (array_values($resul) as $value) {
						printf("<option value=\"%s\">%s</option>",$value['num_almacen'],$value['localidad']);
					}

				?>
			</select>
			<br>
			<input type="submit" name="enviar">
		</form>


		<?php

			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				// $conn = conexionBBDD();

				aprovisionarProductos($conn);
			}

			
			function aprovisionarProductos($conn){

				$num_almacen = strlen($_POST['num_almacen']) == 0 ? 0 : $_POST['num_almacen'];
				$id_producto = $_POST['id_producto'];
				$cantidad_producto = $_POST['cantidad_producto'];

				
				$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				$sql = "SELECT * FROM almacena WHERE num_almacen = ".$num_almacen." AND id_producto = \"".$id_producto."\"";


				$stmt = $conn -> prepare($sql);
				$stmt -> execute();

				$stmt -> setFetchMode(PDO::FETCH_ASSOC);

				$resul = $stmt -> fetchAll();


				
				
				if(count($resul) == 0){

					// No existe en la tabla. Hago Insert
					echo "Insertando";
					$sql_insert = "INSERT INTO almacena (num_almacen, id_producto, cantidad) VALUES (:num_almacen, :id_producto, :cantidad);";
					$stmt_insert = $conn -> prepare($sql_insert);

					$stmt_insert -> bindParam(':num_almacen', $num_almacen);
					$stmt_insert -> bindParam(':id_producto', $id_producto);
					$stmt_insert -> bindParam(':cantidad', $cantidad_producto);

					$stmt_insert -> execute();
				}else {

					// Existe. Hago update a la cantidad
					echo "Actualizando valor";
					
					$sql_update = "UPDATE almacena  SET cantidad=cantidad+:cantidad WHERE num_almacen=:num_almacen AND id_producto=:id_producto";

					$stmt_update = $conn -> prepare($sql_update);

					$stmt_update -> bindParam(':cantidad', $cantidad_producto);

					$stmt_update -> bindParam(':num_almacen', $num_almacen);
					$stmt_update -> bindParam(':id_producto', $id_producto);

					$stmt_update -> execute();
				}
			}

		?>
	</body>
</html>