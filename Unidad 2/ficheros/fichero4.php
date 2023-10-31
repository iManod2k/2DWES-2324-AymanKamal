
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
		$fichero = file("alumnos2.txt");
		
		echo "<table>";
		echo 	"<tr>
					<th>Nombre</th>
					<th>Apellido 1</th>
					<th>Apellido 2</th>
					<th>Fecha de Nacimiento</th>
					<th>Localidad</th>
				</tr>";
				
				
				
		forEach($fichero as $key => $value){
			$array = explode("##", $value);
				echo "<tr>";
				
					printf("<td>%s</td>", $array[0]);
					printf("<td>%s</td>", $array[1]);
					printf("<td>%s</td>", $array[2]);
					printf("<td>%s</td>", $array[3]);
					printf("<td>%s</td>", $array[4]);
					
				echo "</tr>";
		}
		
		
				echo "</table>";
				
				echo "<br/><br/>";
				
				print(count($fichero)." filas");
		
	?>
</body>
</html>