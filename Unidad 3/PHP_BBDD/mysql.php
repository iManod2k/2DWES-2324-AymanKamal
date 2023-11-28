<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "empleados1n";

	$sql = "SELECT * FROM departamento";

	try {
	$conn = new PDO("mysql:host=$servername;dbname=".$dbname, 
	$username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	echo "Connected successfully";

	
	forEach($conn -> query($sql) as $fila){
		echo '<br>';
		echo $fila['cod_dpto']." ".$fila['nombre_dpto'];
	}
	// echo $conn -> fetch();

	}
	catch(PDOException $e)
	{
	echo "Connection failed: " . $e->getMessage();
	}

?>