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
				
				mostrarInfoProducto($conn);
			}

				

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
		?>
	</body>
</html>