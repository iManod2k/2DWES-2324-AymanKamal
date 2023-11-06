
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
	<h1>Operaciones Sistemas Ficheros</h1>
	<form name="fichero7" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">		
			<label>Fichero Origen(Path/Nombre)</label>
			<input type="text" name="rutaOrigen" value="C:\wamp64\www\2DWES-2324-AymanKamal\Unidad 2\ficheros\quijote.txt"></input>
			<br>
			<label>Fichero Destino(Path/Nombre)</label>
			<input type="text" name="rutaDestino" value="C:\wamp64\www\2DWES-2324-AymanKamal\Unidad 2\ficheros\quijote2.txt"></input>
			<br><br>
			<input type="radio" name="opc" value="copyFile" checked>Copiar Ficher Fichero</input>
			<br>
			<input type="radio" name="opc" value="renameFile">Renombrar Fichero</input>
			<br>
			<input type="radio" name="opc" value="deleteFile">Borrar Fichero</input>
			<br>
			<br>
			
			<input type="submit" name="Enviar" value="Ejecutar Operacion"/>
			<input type="reset" name="Borrar"/>
	</form>
	
	
	<?php
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			
			$ruta_org = $_POST['rutaOrigen'];
			$ruta_des = $_POST['rutaDestino'];
			
			$opciones = $_POST['opc'];
			
			
			
			switch($opciones){
				case "copyFile":
				comprobarFichero1($ruta_org, $ruta_des, $opciones);
				comprobarFichero2($ruta_org, $ruta_des, $opciones);
				
					if(copy($ruta_org, $ruta_des) === true){
						echo "Se ha copiado exitosamente !";
					}else {
						echo "Error al copiar";
					}
				break;
				case "renameFile":
				comprobarFichero1($ruta_org, $ruta_des, $opciones);
					if(rename($ruta_org, basename($ruta_des))){
						echo "Se ha renombrado!";
					}else {
						echo "Error al renombrar!";
					}
				break;
				case "deleteFile":
					if(!file_exists($ruta_org)){
						echo "El archivo no existe. No se borra";
					}else {
						if(unlink($ruta_org)){
							echo "Se ha eliminado!";
						}else {
							echo "Error al eliminar!";
						}
					}
				break;
			}
			
			
		}
		
		
		function comprobarFichero1($ruta_org, $ruta_des, $opciones){
			if(!file_exists(dirname($ruta_org))){
				echo "Carpeta no existe. Creandola";
				mkdir(dirname($ruta_org), 777, true);
			}
			if(!file_exists($ruta_org)){
				echo "Archivo no existe. Creandolo";
				fopen($ruta_org, "w");
			}
		}
			
		function comprobarFichero2($ruta_org, $ruta_des, $opciones){
			if(!file_exists(dirname($ruta_des))){
				echo "Carpeta no existe. Creandola";
				mkdir(dirname($ruta_des), 777, true);
			}
			/*
			if(!file_exists($ruta_des)){
				echo "Archivo no existe. Creandolo";
				fopen($ruta_des, "w");
			}
			*/
		}
	?>
</body>
</html>