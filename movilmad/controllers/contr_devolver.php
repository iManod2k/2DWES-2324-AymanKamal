<?php
	session_start();

?>

<?php


require ("../models/db_connexion.php");


	if( isset($_POST['volver']) ) {
		header("Location: ../movwelcome.php");
	}

	
	if ( isset($_POST['devolver']) && $_POST['vehiculos'] == 'null' ){ // Si no tiene alquiler y presiona boton...
		
		header("Location: ../movdevolver.php");
	}else {

		payment();
	}


		function payment() {

			$matricula = $_POST['vehiculos'];
			$idcliente = $_SESSION['info_user']['idcliente'];

			$conexion = new Database();
			$conexion -> pay_rentedCar($idcliente, $matricula);
		}
?>