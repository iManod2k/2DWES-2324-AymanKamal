<?php
	if( !isset($_COOKIE['user']) ){
		header("Location: comlogincli.php ");
	}
?>



<html>

<body>
	
	<h1> <?php echo "Historial de compras ".$_COOKIE['user']; ?></h1>

		<form name="history" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

			<label for="fecha_desde">Desde la fecha...: </label>
			<input type="date" name="fecha_desde" value="2000-01-01">
			<br>
			<label for="fecha_hasta">Hasta la fecha...: </label>
			<input type="date" name="fecha_hasta" value="2030-01-01">
			<br>

			<input type="submit" name="query_historial" value="Ver historial">
			<input type="submit" name="compras" value="VOLVER COMPRA">
		</form>



	<?php

		// CONTINUAR


		if( isset($_POST['query_historial']) ){
			include '../../Unidad 3/webcompras/conexion.php';

			$conn = conexionBBDD();

			$nif = $_COOKIE['nif'];
			$fecha_d = str_replace("-", "/", $_POST['fecha_desde']);
			$fecha_h = str_replace("-", "/", $_POST['fecha_hasta']);

			echo $fecha_d;
			echo "<br>";
			echo $fecha_h;


			try{
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				$sql = "SELECT * FROM compra WHERE nif = :nif AND fecha_compra >= :fecha_desde AND fecha_compra <= :fecha_hasta;";

				$stmt = $conn -> prepare($sql);

				$stmt -> bindParam(':nif', $nif);
				$stmt -> bindParam(':fecha_desde', $fecha_d);
				$stmt -> bindParam(':fecha_hasta', $fecha_h);

				$stmt -> execute();

				$stmt -> setFetchMode(PDO::FETCH_ASSOC);

				$resul = $stmt -> fetchAll();

				// var_dump($resul);


				foreach ($resul as $fila => $valores) {
					print_r($valores);
					echo "<br>";
				// $codigo_name = $valores['NUM_ALMACEN']."##".$valores['ID_PRODUCTO']."##".$valores['CANTIDAD'];
				}



			}catch(PDOException $e){

				echo "ERROR";
				echo "<br>";
				echo $e;
			}
		}




		if( isset($_POST['compras']) ){

			try{
				
				header("Location: comprocli.php");
			}catch(PDOException $e){

				echo "ERROR";
				echo "<br>";
				echo $e;
			}
		}

		

	?>


</body>

</html>