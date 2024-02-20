<?php
	session_start();
?>
<?php


	require_once("../models/db_connexion.php");
	include "../redsys/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php";


	if( !empty($_GET) ){


		$info = decode_payment_info();
		
			if ($info['Ds_Response'] >= "0000" && $info['Ds_Response'] <= "0099") {

				$conexion = new Database();

				$fecha_actual_alq_string = $_SESSION['info_compra']['fecha_actual_alq_string'];
				$precio_total = $_SESSION['info_compra']['precio_total'];
				$idcliente = $_SESSION['info_compra']['idcliente'];
				$matricula = $_SESSION['info_compra']['matricula'];


				$fecha_actual = new DateTime();
				$fecha_actual_string = $fecha_actual -> format('Y-m-d H:i:s');
				

				$conn = $conexion -> create_persistent_connection();
			
				$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				$stmt1 = $conn -> prepare("UPDATE ralquileres
											SET fechahorapago = '$fecha_actual_string';
											WHERE idcliente = '$idcliente' AND matricula = '$matricula';");
				$stmt1 -> execute();

				// $stmt2 = $conn -> prepare("UPDATE rvehiculos
				// 							SET disponible = 'S'
				// 							WHERE matricula = '$matricula';");
				// $stmt2 -> execute();

				$conn = null;

			}else {
				// Nada
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