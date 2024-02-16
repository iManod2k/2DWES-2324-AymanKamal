<?php
	session_start();
?>

<?php
	
	require ("../models/db_connexion.php");
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	

	// $conexion = new Database();
	$user_exist = Database::is_userExist($email, $password);

	if( count($user_exist) == 1){

		$_SESSION['info_user'] = $user_exist[0];
		header("Location: ../movwelcome.php");
	}





	
	

?>