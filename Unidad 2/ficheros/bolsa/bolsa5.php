<html>
<head>
<style>

</style>
</head>
<body>
	<h1>Consulta de Operaciones Bolsa</h1>
	<form name="form_info" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">		
			<label>Mostrar: </label>
			<select type="text" name="totales">
				<option value="tvol">Total Volumen</option>
				<option value="tcapit">Total Capitalización</option>
			</select>
			
			<br><br>
			<input type="submit" name="Enviar" value="Ejecutar Operacion"/>
			<input type="reset" name="Borrar"/>
	</form>
	
	
	<?php
		if($_SERVER['REQUEST_METHOD']=="POST"){
			
			require "funciones_bolsa.php";
			
			$opcion = $_POST['totales'];
			
			$datos = leerFichero();
			$volumen = 0;
			$capitalizacion = 0;
			
			forEach(array_keys($datos) as $key){
				
				$volumen += floatval(str_replace(".", "", $datos[$key][6]));
				$capitalizacion += floatval(str_replace(".", "", $datos[$key][7]));
			}
			
			switch($opcion){
				case 'tvol' : 	
					echo "TOTAL VOLUMEN -> ".$volumen;
				break;
				
				case 'tcapit' : 
					echo "TOTAL CAPITALIZACION -> ".$capitalizacion;
				break;
			}
			
			
		}
	?>
</body>
</html>