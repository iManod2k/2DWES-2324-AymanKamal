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
			
			
			
			<input type="submit" name="Enviar" value="Ejecutar Operacion"/>
			<input type="reset" name="Borrar"/>
	</form>
	
	
	<?php
		if($_SERVER['REQUEST_METHOD']=="POST"){
			
			
			$nombreEmpresas = strtoupper($_POST['nombreEmpresas']);
			echo "El valor <b>Cotización</b> de ".$nombreEmpresas." es ".$datos[$nombreEmpresas][0];
			echo "<br>";
			echo "El valor <b>Cotización Máxima</b> de ".$nombreEmpresas." es ".$datos[$nombreEmpresas][1];
			echo "<br>";
			echo "El valor <b>Cotización Mínima</b> de ".$nombreEmpresas." es ".$datos[$nombreEmpresas][2];
			
		}
	?>
</body>
</html>