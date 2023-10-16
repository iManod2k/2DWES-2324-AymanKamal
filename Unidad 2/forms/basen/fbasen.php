<html>
	<body>
		<h1>Conversor de N a N potencia</h1>
		
		<form name="conv_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">		
			<label>Numero:</label>
			<input name="num" type="text"  placeholder="numero/base"></input>
			<br>
			<label>Base:</label>
			<input name="base" type="num" value="2"></input>
			
			<br><br>
			
			<input type="submit" value="Enviar"></input>
			<input type="reset" value="Borrar"></input>
		</form>
		
		
		
		
		<?php
			require "../funciones.php";
			
			
			if($_SERVER['REQUEST_METHOD'] == "POST"){
				$valor = $_POST['num'];
				$base= $_POST['base'];
				
				$numero_base = explode("/", $valor, 2); // Maximo me lo separas en 2 partes

				if(isFormatoCorrecto($numero_base)){
					$numero = convertirBase($numero_base[0], $numero_base[1]);
					$numero_nuevaBase = convertirBase($numero, $base);
					
					echo "El numero ".$numero_base[0]." en base ".$numero_base[1]." = ".$numero_nuevaBase;
				}else {
					echo "Error !";
				}
			}
		?>
	</body>
</html>