<?php
	session_start();

	if( !isset($_SESSION['carrito'])  ){
		$_SESSION['carrito'] = [];
	}
?>

<?php

	$carrito = $_SESSION['carrito'];



	// --- Agregar
	if( isset($_POST['agregar']) && count($_SESSION['carrito']) < 3 ){
		
		$vehiculo = $_POST['vehiculos'];

		if ( !in_array($vehiculo, $carrito) ) { // Si el artículo no existe en la cesta, añádelo

			$carrito[] = $vehiculo;
			$_SESSION['carrito'] = $carrito;
		}

		header("Location: ../movalquilar.php");
	}



	// --- Alquilar
	if( isset($_POST['alquilar']) ){

		require "../models/db_connexion.php";

		if( can_rent() ){
			rent();
			echo "Alquilado";
		}else {
			// No puedes alquilar
			echo "No Alquilado";
		}
	}


		function can_rent(){

			$carrito = $_SESSION['carrito'];
			$id_cliente = $_SESSION['info_user']['idcliente'];
			
			$conexion = new Database();
			$coches_alquilados = $conexion -> count_ClientRentedCars($id_cliente);
			
			if( $coches_alquilados <= 3 && ($coches_alquilados + count($carrito) <= 3 ) ){
				return true;
			}else {
				return false;
			}
		}


		function rent() {

			global $carrito;

			$conexion = new Database();
			$id_cliente = $_SESSION['info_user']['idcliente'];

				for($i=0; $i<count($carrito); $i++){
					
					$matricula = $carrito[$i];
					$conexion -> make_order($id_cliente ,$matricula);
				}

			$_SESSION['carrito'] = [];
		}



	// --- Vaciar Cesta

	if( isset($_POST['vaciar']) ){

		$_SESSION['carrito'] = [];
		header("Refresh: 0; ../movalquilar.php");
	}
?>