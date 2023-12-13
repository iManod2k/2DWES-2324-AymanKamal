<html>
	<head></head>
	<body>

		<form name="alta_dep" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			
			<label for="fecha_fin">Fecha de Finalizacion</label>
			<input type="date" name="fecha_fin" value="2023-12-13">
			<br>
			<br>
			<input type="submit" name="enviar">
		</form>

		<?php
			
			if($_SERVER['REQUEST_METHOD'] == "POST"){

				require "funciones.php";

				$fecha_fin = $_POST['fecha_fin'];
				$fecha_editada = str_replace("-", ":", $fecha_fin);




				$resul = select("SELECT * FROM emple_depart WHERE fecha_fin = '".$fecha_editada."' ORDER BY dni, cod_dpto");

				foreach (array_values($resul) as $value) {
					echo "<br>";
					$sql_nombre = select("SELECT nombre FROM empleado WHERE dni = '".$value['dni']."' ")[0]['nombre'];
					$sql_dep = select("SELECT nombre_dpto FROM departamento WHERE cod_dpto = '".$value['cod_dpto']."' ")[0]['nombre_dpto'];

					echo $sql_nombre." trabajó en ".$sql_dep." en esa fecha";
				}

				
			}
			
		?>

	</body>
</html>
