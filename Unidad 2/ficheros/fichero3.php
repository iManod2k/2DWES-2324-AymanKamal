
<html>
<head>
<style>
	td{
		border: solid 1px red;
		text-align: center;
	}
</style>
</head>
<body>
	<?php
		$fichero = file("alumnos1.txt");
		
		echo "<table>";
		echo 	"<tr>
					<th>Nombre</th>
					<th>Apellido 1</th>
					<th>Apellido 2</th>
					<th>Fecha de Nacimiento</th>
					<th>Localidad</th>
				</tr>";
		foreach($fichero as $linea => $string){
			echo "<tr>";
				$nombre = substr($string, 0, 40);
				$apellido1 = substr($string, 40, 40);
				$apellido2 = substr($string, 80, 41);
				$fecha_nacimiento = substr($string, 121, 10);
				$localidad = substr($string, 131, 27);
				
				printf("<td>%s</td>", $nombre);
				printf("<td>%s</td>", $apellido1);
				printf("<td>%s</td>", $apellido2);
				printf("<td>%s</td>", $fecha_nacimiento);
				printf("<td>%s</td>", $localidad);
				
			echo "</tr>";
		}
		echo "</table>";
		
		echo "<br/><br/>";
		
		
		echo "Se ha leído un total de ".count($fichero)." filas";
	?>
</body>
</html>