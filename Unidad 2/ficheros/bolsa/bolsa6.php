<html>
<head>
<style>

</style>
</head>
<body>
	<h1>Consulta de Operaciones Bolsa</h1>
	
	
	<?php
			require "funciones_bolsa.php";
			
			$datos = leerFichero();
			$max_cotizacion = 0;
			$min_cotizacion = 0;
			$max_volumen = 0;
			echo "<p>Total de Valores: ".count($datos)."</p>";
			
			forEach($datos as $key => $value){
				
				$numero = floatval(str_replace(",",".",$value[4]));
				
				if($numero > $max_cotizacion){
					$max_cotizacion = $numero;
				}
				
				$numero_v = intval(str_replace(".","",$value[6]));
				
				if($numero_v > $max_volumen){
					$max_volumen = $numero_v;
				}
				
			}
			
			echo "<p>Maximo Cotizacion: ".$max_cotizacion."</p>";
			
			
			$min_cotizacion = $max_cotizacion;
			forEach($datos as $key => $value){
				
				$numero = floatval(str_replace(",",".",$value[5]));
				
				if($numero < $min_cotizacion){
					$min_cotizacion = $numero;
				}
				
			}
			
			echo "<p>Minimo Cotizacion: ".$min_cotizacion."</p>";
			echo "<p>Maximo Volumen: ".$max_volumen."</p>";
			
			
	?>
</body>
</html>