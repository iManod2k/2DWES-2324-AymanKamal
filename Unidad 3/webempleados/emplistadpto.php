<html>
	<head></head>
	<body>

		<form name="alta_dep" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<label for="cod_dpto">Deparatmento</label>
			<select name="cod_dpto">
				<?php

					require "funciones.php";
					$resul = select("SELECT * FROM departamento");


					foreach (array_values($resul) as $value) {
						printf("<option value=\"%s\">%s</option>",$value['cod_dpto'],$value['nombre_dpto']);
					}

				?>
			</select>
			<br>
			<br>
			<input type="submit" name="enviar">
		</form>

		<?php
			
			if($_SERVER['REQUEST_METHOD'] == "POST"){

				$cod_dpto = $_POST['cod_dpto'];

				$resul = select("SELECT dni FROM emple_depart GROUP BY dni");

				$sql_where = "";
				foreach (array_values($resul) as $value) {
					$sql_where .= "dni = '".$value['dni']."' OR ";	// Creo la sentencia WHERE
				}

				$sql_where = substr($sql_where, 0, strlen($sql_where)-4 ); // Elimino el último "... OR "


				$resul2 = select("SELECT dni, nombre FROM empleado WHERE ".$sql_where);

				foreach (array_values($resul2) as $value) {
					echo "Nombre -> ".$value['nombre'];
					echo "<br>";
				}

			}
			
		?>

	</body>
</html>
