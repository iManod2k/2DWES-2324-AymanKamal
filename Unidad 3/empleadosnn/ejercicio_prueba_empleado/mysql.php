<html>
	
	<head>
		<style>

		</style>
	</head>
	<body>
		
		<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
			<h2>ALTA EMPLEADO</h2>
			<label for="lbl_cod_emp"></label>
			<input type="text" name="cod_emp" value="33333333A"></input>
			<label for="lbl_nom_emp"></label>
			<input type="text" name="nom_emp" value="AYMAN"></input>
			<label for="lbl_sal_emp"></label>
			<input type="text" name="sal_emp" value="5000"></input>
			<label for="lbl_cod_dep_emp"></label>
			<input type="text" name="fecha_nac" value="2000-06-08"></input>
			<input type="submit" name="enviar" value="CREAR EMP">
		</form>



		<?php

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "empleadosnn";

			$sql = "INSERT INTO empleado (dni,nombre_emple,salario,fecha_nac) VALUES (:cod_emp,:nom_emp,:salario,:fecha_nac);";

			try {
			$conn = new PDO("mysql:host=$servername;dbname=".$dbname, 
			$username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			echo "Connected successfully";


			
			$stmt = $conn -> prepare($sql);

			$stmt -> bindParam(':cod_emp', $cod_emp);
			$stmt -> bindParam(':nom_emp', $nom_emp);
			$stmt -> bindParam(':salario', $salario);
			$stmt -> bindParam(':fecha_nac', $fecha_nac);
			$cod_emp = $_POST['cod_emp'];
			$nom_emp = $_POST['nom_emp'];
			$salario = $_POST['sal_emp'];
			$fecha_nac = $_POST['fecha_nac'];

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