<?php


	require_once("../models/db_connexion.php");
	include "../redsys/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php";


	if( !empty($_GET) ){

		// $conexion = new Database();
		// $conexion = $conexion -> create_connection_persistent();
		// $conexion = $conexion -> get_staticConnection();

		$conexion = Database::get_staticConnection();

		$info = decode_payment_info();
		
			if ($info['Ds_Response'] >= "0000" && $info['Ds_Response'] <= "0099") {

				$conexion -> commit();
			}else {
				$conexion -> rollback();
			}

		// header("Location: ../movdevolver.php");
	}





		function decode_payment_info(){
			$miObj = new RedsysAPI;

			$version = $_GET["Ds_SignatureVersion"];
			$datos = $_GET["Ds_MerchantParameters"];
			$signatureRecibida = $_GET["Ds_Signature"];


			$decodec = $miObj->decodeMerchantParameters($datos);	
			$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
			$firma = $miObj->createMerchantSignatureNotif($kc,$datos);


			$decodec = json_decode($decodec, true);
			return $decodec;
		}

?>