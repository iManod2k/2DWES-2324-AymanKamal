<?php

	require ($_SERVER['DOCUMENT_ROOT']."/Unidad 4/MVC - Práctica MOVILMAD-20240212/movilmad/movconfig.php");


	class Database {

		private static $static_connexion;

		private static $servername = DB_SERVER;
		private static $username = DB_USERNAME;
		private static $password = DB_PASSWORD;
		private static $dbname = DB_DATABASE;

		private function __construct() {

		}

		public static function create_connection() {
			$connection = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname,self::$username,self::$password);
			$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $connection;
		}

		public static function create_connection_persistent() {

			if( empty(self::$static_connexion) ){
				self::$static_connexion = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname,self::$username,self::$password, array(PDO::ATTR_PERSISTENT => true));
			self::$static_connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			}

			return self::$static_connexion;
		}


		public static function get_staticConnection(){
			return self::$static_connexion;
		}


		public static function select($sentence) {

			$conn  = self:: create_connection();

			$statement = $conn -> prepare($sentence);
			$statement -> execute();

			$statement -> setFetchMode(PDO::FETCH_ASSOC);

			$resul = $statement -> fetchAll();
			return $resul;
		}

		public function alter($sentencia) {

			try {

				$conn  = self:: create_connection();

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


		public static function is_userExist($email, $password){

			$var = self::select("SELECT * FROM `rclientes`
									WHERE idcliente = $password 
									AND email = '$email'
									AND fecha_baja IS NULL;");
			// Puede entrar CON pagos pendientes...

			return  $var;
		}


		public static function cars_free(){

			$var = self:: select("SELECT * FROM `rvehiculos` WHERE disponible = 'S';");

			return  $var;
		}



		public static function count_ClientRentedCars($id_cliente){

			$var = self:: select("SELECT count(*) as total FROM `ralquileres` WHERE '$id_cliente' = idcliente
									AND fecha_devolucion IS NULL;");

			return  $var[0]['total'];
		}


		public static function make_order($id_cliente, $matricula){

			$occupy_vehicle = self:: alter(" UPDATE rvehiculos SET disponible = 'N'
												WHERE matricula = '$matricula';");
			$insert_occupied_vehicle = self:: alter("INSERT INTO ralquileres (idcliente, matricula, fecha_alquiler, fecha_devolucion, preciototal, fechahorapago) VALUES ('$id_cliente', '$matricula', NOW(), null, null, null);");


			if ($occupy_vehicle == null || $insert_occupied_vehicle == null) {
				print("Error al alquilar vehiculos");
				return false;
			}

			return true;

		}




		public static function user_rentedCars($idcliente) {

			$vehicles = self:: select("SELECT matricula FROM ralquileres WHERE idcliente = '$idcliente'
								AND fecha_devolucion IS NULL;");

			return array_values($vehicles);
		}


		public static function get_carPrice($matricula) {

			$vehicles = self:: select("SELECT preciobase FROM `rvehiculos` WHERE matricula = '$matricula' LIMIT 1;");

			return str_replace(",", ".", array_values($vehicles)[0]['preciobase']);
		}


		public static function get_carRentDates($idcliente, $matricula) {

			$vehicles = self:: select("SELECT fecha_alquiler, fecha_devolucion, fechahorapago
										FROM ralquileres WHERE matricula = '$matricula'
										AND '$idcliente' = idcliente
										LIMIT 1;");

			return $vehicles[0];
		}




		public static function pay_rentedCar($idcliente, $matricula){

			$precio_coche = self::get_carPrice($matricula);
			$precio_coche = floatval($precio_coche);

			$fecha_inicio_alq = new DateTime(self:: get_carRentDates($idcliente, $matricula)['fecha_alquiler']);
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


			// $conn = self::create_connection_persistent();
			// Estoy utilizando la variable global private static para trabajar
			self::create_connection_persistent();
			
				self::beginTransaction();
				self::setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			$stmt1 = $conn -> prepare("UPDATE ralquileres
										SET fecha_devolucion = '$fecha_actual_alq_string',
											preciototal = '$precio_total'
										WHERE idcliente = '$idcliente' AND matricula = '$matricula';");
			$stmt1 -> execute();
///

			$stmt2 = $conn -> prepare("UPDATE rvehiculos
										SET disponible = 'S'
										WHERE matricula = '$matricula';");
			$stmt2 -> execute();

		
			$clave_redsys = getrandmax();
			redsys_payment($conn, $clave_redsys, $precio_total);

		}


	}





	function redsys_payment($conn, $clave_redsys, $precio_total) {

		include "../redsys/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php";

		$redsys = new RedsysAPI;

		$ip = "192.168.22.48";
	
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

	// Objeto Redsys
		$redsys->setParameter("DS_MERCHANT_ORDER", "1234".$clave_redsys);
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