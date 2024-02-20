<?php
	session_start();
?>

<?php
	
	require("../views/view_consultar.php");

	$id = $_SESSION['info_user']['idcliente'];
	$fechadesde = $_POST['fechadesde'];
	$fechahasta = $_POST['fechahasta'];
	
	if( isset($_POST['Consultar']) ){
		
		require("../models/db_connexion.php");

		$conn = new Database();

		$cars = $conn -> get_cars_Date($id, $fechadesde, $fechahasta);

		for($i=0; $i<count($cars); $i++){

			show_cars($cars[$i]);
		}


	}

?>