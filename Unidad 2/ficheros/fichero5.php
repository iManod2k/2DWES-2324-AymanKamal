
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
	<form name="fichero5" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">		
			<label>Fichero (Path/Nombre)</label>
			<input type="text" name="ruta" value="quijote.txt"></input>
			<br><br>
			<label>Operaciones:</label>
			<br>
			<input type="radio" name="opc" value="showall" checked>Mostrar Fichero</input>
			<br>
			<input type="radio" name="opc" value="showline">Mostrar linea <input type="text" name="numlinea" size="1"/> fichero</input>
			<br>
			<input type="radio" name="opc" value="showxlines">Mostrar <input type="text" name="numlineas" size="1"/> primeras lineas</input>
			<br>
			
			<br>
			<br>
			<input type="submit" name="Enviar"/>
			<input type="reset" name="Borrar"/>
	</form>
	
	
	<?php
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			
			$ruta = $_POST['ruta'];
			
			
			if(file_exists($ruta) === true && !(substr(strtolower($ruta),0,3)=="c:/") && !($ruta[0]=="/")){
				
				$fichero = file($ruta);
				$opciones = $_POST['opc'];
				switch($opciones ){
					case "showall":
						foreach($fichero as $key => $value){
							echo $value;
						}
					break;
					case "showline":
					$linea = $_POST['numlinea']==""?"0":$_POST['numlinea'];
						echo $fichero[$linea];
					break;
					case "showxlines":
						$linea = $_POST['numlineas']==""?"1":$_POST['numlineas'];
						for($i=0; $i<$linea; $i++){
							echo $fichero[$i];
						}
					break;
				}
			}else {
				echo "el archivo no existe";
			}
			
			
		}
			
	?>
</body>
</html>