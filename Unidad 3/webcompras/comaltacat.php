<html>
	<head></head>
	<body>
		
<!--
ID_CATEGORIA VARCHAR(5)
NOMBRE VARCHAR(40)

-->
		<form name="categoria" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

			<label for="nombre_categoria">Nombre Categoría</label>
			<input type="text" name="nombre_categoria" value="Categoria">
			
			<input type="submit" name="enviar">
		</form>


		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$nombre_categoria = $_POST['nombre_categoria'];

				if(strlen($nombre_categoria) >= 1 && strlen($nombre_categoria) <= 40){

					try{
						$conn = conexionBBDD();

							echo "guay";
							existeIdCategoria($conn, $nombre_categoria);

					}catch(PDOException $e){
						echo $e;
					}
				}
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
			function existeIdCategoria($conn, $nombre_categoria){
				
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				echo "Conectado";

				$sql = "SELECT MAX(ID_CATEGORIA) as ID_CATEGORIA FROM categoria";

				$stmt = $conn -> prepare($sql);
				$stmt -> execute();

				$stmt -> setFetchMode(PDO::FETCH_ASSOC);

				$resul = $stmt -> fetchAll();

				$sql_insert = "INSERT INTO categoria (ID_CATEGORIA,NOMBRE) VALUES (:codigo, :nombre);";

				$stmt_insert = $conn -> prepare($sql_insert);
				
				if(strlen($resul[0]['ID_CATEGORIA']) == 0 ){
					echo "ta vacio";
					
					$codigo = "C-001";
					$stmt_insert -> bindParam(':codigo', $codigo);

					echo "Inserción satisf";
				}else {
					echo "ta lleno";

					$codigo_aumentado = intval(substr($resul[0]['ID_CATEGORIA'] , -3))+1;
					$codigo = "C-".str_pad($codigo_aumentado,3,"0", STR_PAD_LEFT);

					$stmt_insert -> bindParam(':codigo', $codigo);
				}

				$stmt_insert -> bindParam(':nombre', $nombre_categoria);
				$stmt_insert -> execute();
				
			}
		?>
	</body>
</html>