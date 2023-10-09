<html>
	<body>
		<h1>Calculadora</h1>
		
		<form name="calcu" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">		
			<label>Operando1</label>
			<input type="number" name="op1" value="5"></input>
			<br><br>
			<label>Operando2</label>
			<input type="number" name="op2" value="5"></input>
			<br><br>
			<label>Selecciona operacion:</label>
			<input type="radio" checked name="tipo_op" value="s">Sumar</input>
			<input type="radio" name="tipo_op" value="r">Restar</input>
			<input type="radio" name="tipo_op" value="m">Multiplicar</input>
			<input type="radio" name="tipo_op" value="d">Dividir</input>
			<br><br>
			<input type="submit" value="Enviar"></input>
			<input type="reset" value="Borrar"></input>
		</form>
		
		<?php
		
		# Include -> Advierte | Requiere -> Detiene ante problema
		include 'funciones.php';
		
		
		
			if($_SERVER['REQUEST_METHOD'] == "POST"){
				
				echo "metodo usado -> ".$_SERVER["REQUEST_METHOD"];
	
				$num1 = limpiar_data($_POST['op1']);
				$num2= limpiar_data($_POST['op2']);
				$resul;
				
				$tipo_operacion = $_POST['tipo_op'];
				switch($tipo_operacion){
					case "s" : printf("<h4>El valor de %u + %u = %u</h4>", $num1, $num2, ($num1+$num2)); break;
					case "r" : printf("<h4>El valor de %u - %u = %u</h4>", $num1, $num2, ($num1-$num2)); break;
					case "m" : printf("<h4>El valor de %u * %u = %u</h4>", $num1, $num2, ($num1*$num2)); break;
					case "d" : printf("<h4>El valor de %u / %u = %u</h4>", $num1, $num2, ($num1/$num2)); break;
				}
			}
		?>
	</body>
</html>