<?php
	session_start();

	$ttl = 60; // Segundos

	if(!isset($_SESSION['timeout'])){
		echo "Declarando variable 'timeout'";
		$_SESSION['timeout'] = time();
	}

	$_POST['contador'] = "50";
	


	do{
		$operacion = (time() - $_SESSION['timeout']);
	}while($operacion < $ttl);

	header("Location: sesion_timeout.php");

/*

$operacion = (time() - $_SESSION['timeout']);

echo $operacion;

	if( $operacion >= $ttl){
		session_unset();
		session_destroy();

		
	}
*/

?>