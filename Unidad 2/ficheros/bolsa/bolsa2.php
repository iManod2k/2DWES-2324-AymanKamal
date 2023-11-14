<html>
<head>
<style>

</style>
</head>
<body>
	<h1>Solicitar info Empresa</h1>
	<form name="form_info" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">		
			<label>Nombre de Empresa: </label>
			<input type="text" name="nombreEmpresa"/>
			
			<input type="submit" name="Enviar" value="Ejecutar Operacion"/>
			<input type="reset" name="Borrar"/>
	</form>
	
	
	<?php
		if($_SERVER['REQUEST_METHOD']=="POST"){
			
			include "funciones_bolsa.php";
			
			$nombre = $_POST['nombreEmpresa'];
			
			// Si nos devuelve un Array, quiere decir que ha encontrado los valores
			$mensaje = solicitarInfoEmpresa($nombre);
			if(is_array($mensaje)){
				
				for($i=0; $i<count($cabeceras); $i++){
					echo "El valor de <b>".array_values($cabeceras)[$i]."</b> es ".array_values($mensaje)[$i];
					echo "<br>";
				}
				
			}
			
			
		}
	?>
</body>
</html>