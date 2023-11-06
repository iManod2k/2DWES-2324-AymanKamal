
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
	<h1>Operaciones Ficheros</h1>
	<form name="fichero6" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">		
			<label>Fichero (Path/Nombre)</label>
			<input type="text" name="ruta" value="C:\wamp64\www\2DWES-2324-AymanKamal\Unidad 2\ficheros\quijote.txt"></input>
			<br><br>
			
			<input type="submit" name="Enviar" value="Ver Datos Ficheros"/>
			<input type="reset" name="Borrar"/>
	</form>
	
	
	<?php
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			
			$ruta = $_POST['ruta'];
			echo "<h1>Opoeraciones Ficheros</h1>";
			 
			if(file_exists($ruta) === true){
				
				$ruta_partida = explode("\\",$ruta); // funciona con rutas absoultas, con el \
				$tamanio = filesize($ruta); //en bytes
				
				
				echo "Tamaño: ".ceil($tamanio/1024)." Kb";
				echo "<br>";
				//echo "Nombre: ".$ruta_partida[count($ruta_partida)-1];
				echo "Nombre: ".basename($ruta);
				echo "<br>";
				echo "Directorio: ".dirname($ruta);
				echo "<br>";
				echo "Últ. Fecha de Modificación: ".date("d F Y H:i:s",filemtime($ruta));
			}
		}
			
	?>
</body>
</html>