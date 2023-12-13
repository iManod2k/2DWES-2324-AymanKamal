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

				// $resul = select("SELECT dni FROM emple_depart GROUP BY dni HAVING cod_dpto = '".$cod_dpto."' AND fecha_fin = null");
				$resul = select("SELECT * FROM emple_depart GROUP BY dni HAVING cod_dpto = '".$cod_dpto."' ");

				
				foreach (array_values($resul) as $value) {
					echo $value['dni'];
					echo "<br>";
				}
				
			}
			
		?>

	</body>
</html>
