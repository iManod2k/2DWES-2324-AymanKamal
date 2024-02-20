<?
	session_start();
?>
<?php

	require ($_SERVER['DOCUMENT_ROOT']."/Unidad 4/MVC - Práctica MOVILMAD-20240212/movilmad/movconfig.php");




	class Database {

		private $servername = DB_SERVER;
		private $username = DB_USERNAME;
		private $password = DB_PASSWORD;
		private $dbname = DB_DATABASE;


		public  function create_connection() {
			$connection = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname,$this->username,$this->password);
			$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $connection;
		}
		public  function create_persistent_connection() {
			$connection = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname,$this->username,$this->password, array(PDO::ATTR_PERSISTENT => true) );
			$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $connection;
		}


		public  function select($sentence) {

			$conn  = $this->create_connection();

			$statement = $conn -> prepare($sentence);
			$statement -> execute();

			$statement -> setFetchMode(PDO::FETCH_ASSOC);

			$resul = $statement -> fetchAll();
			return $resul;
		}

		public function alter($sentencia) {

			try {

				$conn  = $this->create_connection();

				$conn -> beginTransaction();
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				$stmt = $conn -> prepare($sentencia);

				$stmt -> execute();
				$conn -> commit();

				return $stmt -> rowCount();

			}catch(PDOException $e){
				$conn -> rollback();
			}


			return null;
			
		}


		public  function is_userExist($email, $password){

			$var = $this->select("SELECT * FROM `rclientes`
									WHERE idcliente = $password 
									AND email = '$email'
									AND fecha_baja IS NULL;");
			// Puede entrar CON pagos pendientes...

			return  $var;
		}


		public  function cars_free(){

			$var = $this->select("SELECT * FROM `rvehiculos` WHERE disponible = 'S';");

			return  $var;
		}



		public  function count_ClientRentedCars($id_cliente){

			$var = $this->select("SELECT count(*) as total FROM `ralquileres` WHERE '$id_cliente' = idcliente
									AND fecha_devolucion IS NULL;");

			return  $var[0]['total'];
		}


		public  function make_order($id_cliente, $matricula){

			$occupy_vehicle = $this->alter(" UPDATE rvehiculos SET disponible = 'N'
												WHERE matricula = '$matricula';");


			$insert_occupied_vehicle = $this->alter("INSERT INTO ralquileres (idcliente, matricula, fecha_alquiler, fecha_devolucion, preciototal, fechahorapago) VALUES ('$id_cliente', '$matricula', NOW(), null, null, null);");


			if ($occupy_vehicle == null || $insert_occupied_vehicle == null) {
				print("Error al alquilar vehiculos");
				return false;
			}

			return true;

		}




		public  function user_rentedCars($idcliente) {

			$vehicles = $this->select("SELECT matricula FROM ralquileres WHERE idcliente = '$idcliente'
								AND fecha_devolucion IS NULL;");

			return array_values($vehicles);
		}


		public  function get_carPrice($matricula) {

			$vehicles = $this->select("SELECT preciobase FROM `rvehiculos` WHERE matricula = '$matricula' LIMIT 1;");

			return str_replace(",", ".", array_values($vehicles)[0]['preciobase']);
		}


		public  function get_carRentDates($idcliente, $matricula) {

			$vehicles = $this->select("SELECT fecha_alquiler, fecha_devolucion, fechahorapago
										FROM ralquileres WHERE matricula = '$matricula'
										AND '$idcliente' = idcliente
										LIMIT 1;");

			return $vehicles[0];
		}




		public  function pay_rentedCar($idcliente, $matricula){

			$precio_coche = self::get_carPrice($matricula);
			$precio_coche = floatval($precio_coche);

			$fecha_inicio_alq = new DateTime($this->get_carRentDates($idcliente, $matricula)['fecha_alquiler']);
			$fecha_actual_alq = new DateTime();
				$fecha_actual_alq_string = $fecha_actual_alq -> format('Y-m-d H:i:s');
			$fecha_pago; // PENDIENTE
			$fecha_diff_alq = $fecha_inicio_alq -> diff($fecha_actual_alq);
			
			
			$minutos_totales = 0;

			
			// Calculo dias
			$dias = $fecha_diff_alq -> days;
			$dias = $dias * (24*60);
			$minutos_totales += $dias;
			
			// Calculo horas
			$horas = $fecha_diff_alq -> h;
			$horas *= 60;
			$minutos_totales += $horas;

			// Calculo minutos
			$minutos = $fecha_diff_alq -> i;
			$minutos_totales += $minutos;

			// Calculo Precio Total
			$precio_total = ($minutos_totales * $precio_coche);
			


			// REDSYS

			$_SESSION['info_compra'] = ["fecha_actual_alq_string" => $fecha_actual_alq_string,
										"precio_total" => $precio_total,
										"idcliente" => $idcliente,
										"matricula" => $matricula];
			
			$conn = $this -> create_persistent_connection();
			
			$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			$stmt1 = $conn -> prepare("UPDATE ralquileres
										SET fecha_devolucion = '$fecha_actual_alq_string',
											preciototal = '$precio_total'
										WHERE idcliente = '$idcliente' AND matricula = '$matricula';");
			$stmt1 -> execute();
// ///

			$stmt2 = $conn -> prepare("UPDATE rvehiculos
										SET disponible = 'S'
										WHERE matricula = '$matricula';");
			$stmt2 -> execute();


			$conn = null;

		
			$clave_redsys = strval(getrandmax());
			redsys_payment($clave_redsys, $precio_total, $precio_coche);

		}



		public function get_cars_Date($id, $fechadesde, $fechahasta){

			$resul = $this -> select("	SELECT * FROM ralquileres
											INNER JOIN rvehiculos
											ON ralquileres.matricula = rvehiculos.matricula
										WHERE idcliente = '$id'
											AND fecha_alquiler >= '$fechadesde'
											AND fecha_alquiler <= '$fechahasta'
									");

			return $resul;
		}



	}





	function redsys_payment($clave_redsys, $precio_total, $precio_default) {

		include "../redsys/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php";

		$redsys = new RedsysAPI;

		$ip = "192.168.206.221";
	
	// Variables
		$fuc="999008881";
		$terminal="1";
		$moneda="978";
		$trans="0";
		$url="";
		$urlOK="http://$ip/Unidad%204/MVC%20-%20Práctica%20MOVILMAD-20240212/movilmad/controllers/payment_done.php";
		$urlKO="http://$ip/Unidad%204/MVC%20-%20Práctica%20MOVILMAD-20240212/movilmad/controllers/payment_done.php";
		$id=time();
		$amount= intval($precio_total*100);
			if( $amount < $precio_default){
				$amount = $precio_default*100;
			}

	// Objeto Redsys
		$redsys->setParameter("DS_MERCHANT_ORDER", strval(rand(1,999)).$clave_redsys);
		$redsys->setParameter("DS_MERCHANT_AMOUNT", (string)$amount);
		$redsys->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
		$redsys->setParameter("DS_MERCHANT_CURRENCY",$moneda);
		$redsys->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
		$redsys->setParameter("DS_MERCHANT_TERMINAL",$terminal);
		$redsys->setParameter("DS_MERCHANT_MERCHANTURL",$url);
		$redsys->setParameter("DS_MERCHANT_URLOK",$urlOK);
		$redsys->setParameter("DS_MERCHANT_URLKO",$urlKO);
		




	//Datos de configuración
		$version="HMAC_SHA256_V1";
		$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
		$request = "";
		$params = $redsys->createMerchantParameters();
		$signature = $redsys->createMerchantSignature($kc);



	// Auto-ejecuto el formulario
	echo "<form action=\"https://sis-t.redsys.es:25443/sis/realizarPago\" method=\"post\" id=\"formu\" target=\"_blank\">
				<input type='hidden' name='Ds_SignatureVersion' value='$version'/>
				<input type='hidden' name='Ds_MerchantParameters' value='$params'/>
				<input type='hidden' name='Ds_Signature' value='$signature'/>
			    <input type=\"submit\" hidden>

		    	<script type=\"text/javascript\">
				    document.getElementById('formu').submit();
				</script>

		   </form>";
	}

?>