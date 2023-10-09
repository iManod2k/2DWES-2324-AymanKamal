<html>
	<body>
		<h1>CONVERSOR BINARIO</h1>
		
		<form name="bin_form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">		
			<label>Numero Decimal</label>
			<input name="num_dec" type="number" value="0"></input>
			
			<?php
			
			require "../funciones.php";
			
				if($_SERVER['REQUEST_METHOD'] == "POST"){
					
					$num = limpiar_data($_POST['num_dec']);
					echo "<br><br>";
					echo "<label>Numero Binario</label><input name=\"num_bin\" type=\"number\" value=".sprintf("%b",$num)."></input>";
				}
				/*
				<br><br>
				echo "<br><br>";
				echo "<label>Numero Binario</label><input name=\"num_bin\" type=\"number\" value=".sprintf("%b",$num)."></input>";
				*/
			?>
			<input type="submit" value="Enviar"></input>
			<input type="reset" value="Borrar"></input>
		</form>
	</body>
</html>