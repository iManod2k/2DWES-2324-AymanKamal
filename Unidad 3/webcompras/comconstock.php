<html>
	<head></head>
	<body>

		<form name="almacen" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

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
			<input type="submit" name="enviar">
		</form>


		<?php

			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				mostrarStock($conn);
			}

			
			function mostrarStock($conn){
				$id_producto = $_POST['id_producto'];

				$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				$sql = "SELECT num_almacen, id_producto, sum(cantidad) as cantidad FROM almacena WHERE id_producto = \"".$id_producto."\" GROUP BY num_almacen";
				$stmt = $conn -> prepare($sql);
				$stmt -> execute();

				$stmt -> setFetchMode(PDO::FETCH_ASSOC);
				$resul = $stmt -> fetchAll();


				
				
				foreach (array_values($resul) as $value) {
					echo "<br>";
					echo "Numero de Almacen -> ".$value['num_almacen'];
					echo "<br>";
					echo "ID del Producto -> ".$value['id_producto'];
					echo "<br>";
					echo "Cantidades -> ".$value['cantidad'];
					echo "<br>";
				}
				
			}
		?>
	</body>
</html>