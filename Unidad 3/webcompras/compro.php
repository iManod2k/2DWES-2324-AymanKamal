<html>
	<head></head>
	<body>

		<form name="almacen" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

			<label for="num_almacen">Numero de Almacen</label>
			<select name="num_almacen">
				<?php

					include 'conexion.php';

					$conn = conexionBBDD();

					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$sql = "SELECT * FROM producto";

					$stmt = $conn -> prepare($sql);
					$stmt -> execute();

					$stmt -> setFetchMode(PDO::FETCH_ASSOC);

					$resul = $stmt -> fetchAll();


					foreach (array_values($resul) as $value	) {
						printf("<option value=\"%s\">%s</option>",$value['ID_PRODUCTO'],$value['NOMBRE']);
					}

				?>
			</select>
			
			<br>
			<label for="cantidad">Cantidad a Comprar:</label>
			<input type="number" name="cantidad" max="100" min="0" value="1">
			<br>
			<input type="submit" name="enviar">
		</form>


		<?php

			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				comprar($conn);
			}


			function comprar($conn){

				buscarCompra($conn);
			}


			function buscarCompra($conn){

				$id_producto = $_POST['num_almacen'];
				$cantidad = $_POST['cantidad']==""?"0":$_POST['cantidad'];

				echo $cantidad;


				$sql_update = "UPDATE almacena SET cantidad=cantidad-:cantidad WHERE id_producto=:id_producto AND :cantidad<=cantidad LIMIT 1";

				$stmt_update = $conn -> prepare($sql_update);
				$stmt_update -> bindParam(':cantidad', $cantidad);
				$stmt_update -> bindParam(':id_producto', $id_producto);

				$stmt_update -> execute();

				/*
					$stmt_update -> bindParam(':num_almacen', $num_almacen);
					$stmt_update -> bindParam(':id_producto', $id_producto);
				*/
			}

/*				

			function mostrarInfoProducto($conn){
				$num_almacen = $_POST['num_almacen'];

				$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				$sql = "SELECT * FROM almacena WHERE num_almacen = :num_almacen";
				$stmt = $conn -> prepare($sql);

				$stmt -> bindParam(':num_almacen', $num_almacen);

				$stmt -> execute();

				$stmt -> setFetchMode(PDO::FETCH_ASSOC);
				$resul = $stmt -> fetchAll();


				foreach (array_values($resul) as $value) {
					echo "<br>";
					echo "Numero de Almacen -> ".$value['NUM_ALMACEN'];
					echo "<br>";
					echo "ID del Producto -> ".$value['ID_PRODUCTO'];
					echo "<br>";
					echo "Cantidades -> ".$value['CANTIDAD'];
					echo "<br>";
				}
			}
			*/
		?>
	</body>
</html>