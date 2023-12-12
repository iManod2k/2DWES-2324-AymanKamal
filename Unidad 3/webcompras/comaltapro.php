<html>
	<head></head>
	<body>
		
<!--
ID_CATEGORIA VARCHAR(5)
NOMBRE VARCHAR(40)

-->
		<form name="categoria" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

			<label for="nombre_producto">Nombre del Producto</label>
			<input type="text" name="nombre_producto" value="Producto">
			<br>
			<label for="precio_producto">Precio del Producto</label>
			<input type="number" name="precio_producto" value="10">
			<br>
			<label for="categoria">Categoria</label>
			<select name="categoria">

				<?php

					$conexion = conexionBBDD();
					$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$sql = "SELECT Nombre, id_categoria FROM categoria";

					$stmt = $conexion -> prepare($sql);
					$stmt -> execute();

					$stmt -> setFetchMode(PDO::FETCH_ASSOC);

					$resul = $stmt -> fetchAll();


					foreach (array_values($resul) as $value) {
						printf("<option value=\"%s\">%s</option>",$value['id_categoria'],$value['Nombre']);
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
				?>
			</select>
			<br>
			<input type="submit" name="enviar">
		</form>


		<?php
		
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$conn = conexionBBDD();

				altaProducto($conn);
			}

			
			function altaProducto($conn){
				
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				$sql = "SELECT MAX(id_producto) as id_producto FROM producto";

				$stmt = $conn -> prepare($sql);
				$stmt -> execute();

				$stmt -> setFetchMode(PDO::FETCH_ASSOC);

				$resul = $stmt -> fetchAll();

				$sql_insert = "INSERT INTO producto (id_producto,nombre, precio, id_categoria) VALUES (:id_producto,:nombre, :precio, :id_categoria);";

				$stmt_insert = $conn -> prepare($sql_insert);
				

				if(strlen($resul[0]['id_producto']) == 0 ){
					echo "ta vacio";
					
					$codigo = "P0001";
					$stmt_insert -> bindParam(':id_producto', $codigo);

					echo "Inserción satisf";
				}else {
					echo "ta lleno";

					$codigo_aumentado = intval(substr($resul[0]['id_producto'] , -4))+1;
					$codigo = "P".str_pad($codigo_aumentado,4,"0", STR_PAD_LEFT);

					$stmt_insert -> bindParam(':id_producto', $codigo);
				}


				$stmt_insert -> bindParam(':nombre', $_POST['nombre_producto']);
				$stmt_insert -> bindParam(':precio', $_POST['precio_producto']);
				$stmt_insert -> bindParam(':id_categoria', $_POST['categoria']);
				$stmt_insert -> execute();
				
			}
			
		?>
	</body>
</html>