<?php
	// Si se le caducan las cookies al cliente, se le acaba el tiempo y vuelve al LOG IN (En 1 minuto caducan las cookies)
	if( !isset($_COOKIE['user']) ){
		header("Location: comlogincli.php ");
	}
?>


<html>
	<head>
		<script type="text/javascript">

			// Cuando me salgo de la pestaña... (incluso al refrescar)
			/*
			window.onunload = function(){
				document.cookie = "user = \"\"; Path=/; Expires=true, 01 Jan 1970 00:00:01";
				document.cookie = "nif = \"\"; Path=/; Expires=true, 01 Jan 1970 00:00:01";
				document.cookie = "ttl = \"\"; Path=/; Expires=true, 01 Jan 1970 00:00:01";
			}
			*/
		</script>
	</head>
	

	<body>
<form name="formulario" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		<h1>Hola <?php echo $_COOKIE['user']; ?></h1>
		<h2>COMPRAAAA !!!!!</h2>
		
		<?php // información genérica
			$cesta = isset($_COOKIE['cesta'])==true?json_decode($_COOKIE['cesta']):array();
			$calculo_ttl = $_COOKIE["ttl"]-time();
			echo "Quedan ".$calculo_ttl." Segundos de sesion ! COMPRA RAPIDOOO";
			echo "<br>";
			echo "Cosas en la cesta: ".count($cesta);
			
			foreach($cesta as $value){
				echo "<br>";
				print_r($value);

			}
		?>

		<br>
		<br>

			<?php // Creo el menú desplegable

				include '../../Unidad 3/webcompras/conexion.php';

				$conn = conexionBBDD();

				try{
					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					$sql = "select * from producto inner join almacena on producto.ID_PRODUCTO = almacena.ID_PRODUCTO inner join almacen on almacena.NUM_ALMACEN = almacen.NUM_ALMACEN;";

					$stmt = $conn -> prepare($sql);
					$stmt -> execute();

					$stmt -> setFetchMode(PDO::FETCH_ASSOC);

					$resul = $stmt -> fetchAll();


					$options = "";


					foreach ($resul as $fila => $valores) {

						$codigo_name = $valores['NUM_ALMACEN']."##".$valores['ID_PRODUCTO']."##".$valores['CANTIDAD'];
$options .= "<option value='".$codigo_name."'>".$valores['NOMBRE']." (\"".$valores['LOCALIDAD']."\") -> ".$valores['CANTIDAD']."</option>";
						// var_dump($valores);
					}

					$select = sprintf("<select name='select_productos'>%s</select>", $options);

					echo "<br><br>";
					echo $select;
				}catch(PDOException $e){

					echo "ERROR";
					echo "<br>";
					echo $e;
				}
			?>

		<input type="number" name="cantidad" min="1" max="100" value="1">
		<input type="submit" name="cesta" value="Añadir Cesta">
		<input type="submit" name="comprar" value="Comprar">
		<input type="submit" name="historial" value="HISTORIAL">


		<br>
		<br>
		<br>
		<br>
		<input type="submit" name="logout" value="LOG OUT">
</form>
	</body>
</html>

<?php


	if(isset($_POST['cesta'])){

		try{

			// Compruebo si hay cesta
			// id_localidad ## id_producto ## cantidad ## cantidad_escrita
			$options_info = explode("##", $_POST['select_productos']."##".$_POST['cantidad']);
			

			if( ($options_info[2] - $options_info[3]) >= 0 ) {
			
				array_push($cesta, $options_info);

				setcookie("cesta", json_encode($cesta), time()+3600 , "/"); // Sobreescribo las Cookies

				header("Refresh: 0");
			}else {

				echo "No hay stock suficiente !";
			}


			// SEGUIR !!!!! ANTES DE HACER UPDATE EN "almacena" E INSERT EN "compra", VERIFICAR SI LA CANTIDAD <= CANTIDAD DISPONIBLE

		}catch(PDOException $e){
			echo "ERROR";
			echo "<br>";
			echo $e;
		}
	}






	if(isset($_POST['comprar'])){
		
		try{

			// id_localidad ## id_producto ## cantidad ## cantidad_escrita

			$seconds_counter = 1;

			foreach($cesta as $value){

				// UPDATE
				$sql_update = "UPDATE almacena  SET cantidad=cantidad-:cantidad WHERE num_almacen = :num_almacen AND id_producto = :id_producto";


				$stmt_update = $conn -> prepare($sql_update);

				$stmt_update -> bindParam(':cantidad', $value[3]);
				$stmt_update -> bindParam(':num_almacen', $value[0]);
				$stmt_update -> bindParam(':id_producto', $value[1]);

				$stmt_update -> execute();

				setcookie("cesta", "", time() - 360000, "/"); // Elimino la Cesta al comprar			

				



				// INSERT

				$time = date("Y-m-d h:i:s a", time() + $seconds_counter);
				$seconds_counter++;
				$sql_insert = "INSERT INTO compra (nif, id_producto, fecha_compra, unidades) VALUES (:nif, :id_producto, :fecha_compra, :unidades);";

				$stmt_insert = $conn -> prepare($sql_insert);


				$stmt_insert -> bindParam(':nif', $_COOKIE['nif']);
				$stmt_insert -> bindParam(':id_producto', $value[1]);
				$stmt_insert -> bindParam(':fecha_compra', $time);
				$stmt_insert -> bindParam(':unidades', $value[3]);

				$stmt_insert -> execute();

			}


			header("Refresh: 0");


		}catch(PDOException $e){
			echo "ERROR";
			echo "<br>";
			echo $e;
		}
	}



// Presiono el botón de LOG OUT (cierro sesión)
	if(isset($_POST['logout'])){
		setcookie("user", "", time() - 3600, "/"); // Elimino las Cookies
		setcookie("nif", "", time() - 3600, "/"); // Elimino las Cookies
		setcookie("ttl", "", time() - 3600, "/"); // Elimino las Cookies
		
		header("Location: comlogincli.php ");
	}



	// Presiono el botón de HISTORIAL
	if(isset($_POST['historial'])){
		
		header("Location: comconscli.php ");
	}
?>