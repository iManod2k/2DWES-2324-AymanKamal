<html>
<head>
<style>

</style>
</head>
<body>
	<h1>Consulta de Operaciones Bolsa</h1>
	<form name="form_info" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">		
			<label>Valores: </label>
			<select type="text" name="nombreEmpresas">
				<?php
					require "funciones_bolsa.php";
					
					$datos = solicitarInfoSelect();
					
					forEach($datos as $key => $value){
						printf("<option value=\"%s\"> %s </option>", strtolower($key), $key);
					}
				?>
			</select>
			
			<br>
			<label>Mostrar: </label>
			<select type="text" name="valorEmpresa">
				<?php
				
					$datos = leerFichero();
					
					forEach($cabeceras as $key => $value){
						printf("<option value=\"%s\"> %s </option>", strtolower($key), $value);
					}
				?>
			</select>
			
			
			<br><br>
			<input type="submit" name="Enviar" value="Ejecutar Operacion"/>
			<input type="reset" name="Borrar"/>
	</form>
	
	
	<?php
		if($_SERVER['REQUEST_METHOD']=="POST"){
			
			
			$nombreEmpresas = strtoupper($_POST['nombreEmpresas']);
			$valorEmpresa = $_POST['valorEmpresa'];
			
			echo "El valor <b>".$cabeceras[$valorEmpresa]."</b> es de ".$datos[$nombreEmpresas][$valorEmpresa];
			
		}
	?>
</body>
</html>