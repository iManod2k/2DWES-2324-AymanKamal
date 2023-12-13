<html>
	<head></head>
	<body>

		<form name="alta_dep" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<label for="dni">DNI</label>
			<select name="dni">
				<?php

					require "funciones.php";

					$resul = select("SELECT dni FROM empleado");

					foreach (array_values($resul) as $value) {
						printf("<option value=\"%s\">%s</option>",$value['dni'],$value['dni']);
					}

				?>
			</select>
			<br>
			<label for="cod_dpto">Deparatmento</label>
			<select name="cod_dpto">
				<?php

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

				$dni = $_POST['dni'];
				$cod_dpto = $_POST['cod_dpto'];

				asignarEmpleadoAdep($dni, $cod_dpto, date("Y-m-d"), "\"\"");

			}
			
		?>

	</body>
</html>