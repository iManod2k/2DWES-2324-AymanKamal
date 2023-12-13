<html>
	<head></head>
	<body>

		<form name="alta_dep" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<label for="dni">DNI</label>
			<input type="text" name="dni" value="06602578Z">
			<br>
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" value="Ayman">
			<br>
			<label for="apellidos">Apellidos</label>
			<input type="text" name="apellidos" value="Kamal">
			<br>
			<label for="fecha_nac">Fecha de Nacimiento</label>
			<input type="date" name="fecha_nac" value="2000-06-08">
			<br>
			<label for="salario">Salario</label>
			<input type="number" name="salario" value="1500.83">
			<br>
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
			<input type="submit" name="enviar">
		</form>

		<?php
			
			if($_SERVER['REQUEST_METHOD'] == "POST"){

				$dni = $_POST['dni'];
				$nombre = $_POST['nombre'];
				$apellidos = $_POST['apellidos'];
				$fecha_nac = $_POST['fecha_nac'];
				$salario = $_POST['salario'];
				$cod_dpto = $_POST['cod_dpto'];

				$resul = select("SELECT dni FROM empleado WHERE \"".$dni."\" = dni");

				if(count($resul) == 0){
					altaEmpleado($dni, $nombre, $apellidos, $fecha_nac, $salario, $cod_dpto);
				}else {
					asignarEmpleadoAdep($dni, $cod_dpto, date("Y-m-d"), "\"\"");
				}

			}
			
		?>

	</body>
</html>