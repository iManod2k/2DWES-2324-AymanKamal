<html>
	<head>
	</head>
	<body>

		<form name="form_inicio" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<label for="seleccion">¿Que desea hacer?</label>
			<select name="seleccion">
				<option value="empaltadpto.php">Dar de alta a un Departamento</option>
				<option value="empaltaemp.php">Dar de alta a un Empleado</option>
				<option value="empcambiodpto.php">Cambiar departamento a Empleado</option>
				<option value="emplistadpto.php">Buscar Empleados en Departamento</option>
				<option value="emphistdpto.php">Buscar puestos Finalizados</option>
				<option value="empsalarioemp.php">Actualizar salario</option>
				<option value="empfecha.php">Buscar puestos y trabajadores finalizados por Fecha</option>
			</select>
			<br>
			<br>
			<input type="submit" name="enviar">
		</form>

		<?php

			if($_SERVER['REQUEST_METHOD'] == "POST"){


				$seleccion = $_POST['seleccion'];

				switch($seleccion){
					case "empaltadpto.php":
						readfile("empaltadpto.html");
					break;
					default:
						header("Location: http://localhost/Unidad%203/webempleados/".$seleccion);
					break;
				}

			}

		?>

	</body>
</html>