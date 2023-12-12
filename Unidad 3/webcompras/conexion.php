<?php
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