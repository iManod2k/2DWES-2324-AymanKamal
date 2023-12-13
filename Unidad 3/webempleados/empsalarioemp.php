<html>
	<head></head>
	<body>

		<form name="alta_dep" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<label for="dni">Deparatmento</label>
			<select name="dni">
				<?php

					require "funciones.php";
					$resul = select("SELECT * FROM empleado");


					foreach (array_values($resul) as $value) {
						printf("<option value=\"%s\">%s</option>",$value['dni'],$value['nombre']);
					}

				?>
			</select>
			<label for="nuevo_salario">Porcentaje</label>
			<input type="number" name="nuevo_salario" value="0">
			<br>
			<br>
			<input type="submit" name="enviar">
		</form>

		<?php
			
			if($_SERVER['REQUEST_METHOD'] == "POST"){


				$dni = $_POST['dni'];

				$nuevo_salario = intval($_POST['nuevo_salario']);
				$salario;

				foreach (array_values($resul) as $value) {

					if($value['dni'] == $dni){
						$salario = intval($value['salario']);
						break;
					}
				}


				$nuevo_salario = $salario + ( ($nuevo_salario * $salario) / 100);



				$sql_update = "UPDATE empleado  SET salario = :salario  WHERE dni = :dni";

				$stmt_update = $conn -> prepare($sql_update);

				$stmt_update -> bindParam(':salario', $nuevo_salario);				
				$stmt_update -> bindParam(':dni', $dni);

				$stmt_update -> execute();
				
			}
			
		?>

	</body>
</html>
