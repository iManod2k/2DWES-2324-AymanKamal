<?php
	
	include("./models/db_connexion.php");

	// $conn = new Database();


	function show_inRent(){

		// global $conn;
		$user = $_SESSION['info_user']['idcliente'];

		$rented = Database::user_rentedCars($user);

		$options = "";

			for($f=0; $f<count($rented); $f++){

				$options .= sprintf("<option value='%s'>%s</option>", $rented[$f]['matricula'], $rented[$f]['matricula']);
			}


			if( count($rented) == 0 ){
				printf("<option value='null'>--- Sin alquileres</option>");
			}else {
				echo $options;
			}

	}

?>