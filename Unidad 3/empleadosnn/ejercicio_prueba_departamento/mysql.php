<html>
	
	<head>
		<style>

		</style>
	</head>
	<body>
		
		<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
			<h2>ALTA DEPARTAMENTO</h2>
			<label for="lbl_cod_dpto"></label>
			<input type="text" name="cod_dpto" value="D003"></input>
			<label for="lbl_nom_dpto"></label>
			<input type="text" name="nom_dpto" value="CEREALES"></input>
			<input type="submit" name="enviar" value="CREAR DPTO">
		</form>



		<?php

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "empleadosnn";

			$sql = "INSERT INTO departamento (cod_dpto,nombre_dpto) VALUES (:cod_dpto,:nom_dpto);";

			try {
			$conn = new PDO("mysql:host=$servername;dbname=".$dbname, 
			$username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			echo "Connected successfully";


			
			$stmt = $conn -> prepare($sql);

			$stmt -> bindParam(':cod_dpto', $cod_dpto);
			$stmt -> bindParam(':nom_dpto', $nom_dpto);
			$cod_dpto = $_POST['cod_dpto'];
			$nom_dpto = $_POST['nom_dpto'];

			$stmt -> execute();


			$conn = null;
			}
			catch(PDOException $e)
			{
			echo "Connection failed: " . $e->getMessage();
			}


		}
		?>
	</body>
</html>