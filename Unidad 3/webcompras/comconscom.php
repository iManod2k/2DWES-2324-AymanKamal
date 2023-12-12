<html>
	<head></head>
	<body>

		<form name="almacen" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

			<label for="personas">Personas</label>
			<select name="personas">
				<?php

					include 'conexion.php';

					$conn = conexionBBDD();

					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$sql = "SELECT * FROM cliente";

					$stmt = $conn -> prepare($sql);
					$stmt -> execute();

					$stmt -> setFetchMode(PDO::FETCH_ASSOC);

					$resul = $stmt -> fetchAll();


					foreach (array_values($resul) as $value) {
						printf("<option value=\"%s\">%s</option>",$value['NIF'],$value['NOMBRE']." ".$value['APELLIDO']);
					}

				?>
			</select>

			<br>
			<label for="fecha_desde">Fecha desde: </label>
			<input type="date" name="fecha_desde">
			<br>
			<label for="fecha_hasta">Fecha hasta:</label>
			<input type="date" name="fecha_hasta">
			
			<br>
			<input type="submit" name="enviar">
		</form>


		<?php

			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				fecha($conn);
			}

				

			function fecha($conn){

				if($_POST['fecha_desde'] <> "" && $_POST['fecha_hasta'] <> "" ){

					$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$sql = "SELECT * FROM compra WHERE fecha_compra >= :fecha_desde AND fecha_compra <= :fecha_hasta";
					$stmt = $conn -> prepare($sql);

					$stmt -> bindParam(':fecha_desde', $_POST['fecha_desde']);
					$stmt -> bindParam(':fecha_hasta', $_POST['fecha_hasta']);

					$stmt -> execute();

					$stmt -> setFetchMode(PDO::FETCH_ASSOC);
					$resul = $stmt -> fetchAll();



					foreach (array_values($resul) as $value) {
						echo "<br>";
						echo "Numero de Almacen -> ".$value['NIF'];
						echo "<br>";
						echo "ID del Producto -> ".$value['ID_PRODUCTO'];
						echo "<br>";
						echo "Cantidades -> ".$value['FECHA_COMPRA'];
						echo "<br>";
						echo "Unidades -> ".$value['UNIDADES'];
						echo "<br>";
					}

				}else {
					echo "Fecha incompleta";
				}
				
				/*

				

				

				


				
				*/
			}

		?>
	</body>
</html>