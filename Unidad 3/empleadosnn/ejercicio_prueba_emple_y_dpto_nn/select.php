<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "empleadosnn";

	$sql = "SELECT * FROM empleado;";


	try{

		$conn = new PDO("mysql:host=$servername;dbname=".$dbname,$username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		echo "Conectado";

		$stmt = $conn -> prepare($sql);
		$stmt -> execute();

		$stmt -> setFetchMode(PDO::FETCH_ASSOC);



		$resul = $stmt -> fetchAll();

		$tabla = "";
		$filas = "";
		$cabecera = true;
		forEach($resul as $fila){

			$columna = "";
			

			if($cabecera){
				$nombre_columnas = array_keys($fila);
				forEach($nombre_columnas as $nombre){
					$columna .= sprintf("<td>%s</td>", $nombre);
				}
				$filas .= sprintf("<tr>%s</tr>",$columna);
				$columna = "";
				$cabecera = false;
			}


			forEach(array_values($fila) as $valor){
				$columna .= sprintf("<td>%s</td>", $valor);
			}

			$filas .= sprintf("<tr>%s</tr>", $columna);
		}

		$tabla = sprintf("<table>%s</table>", $filas);
		echo $tabla;
		



	}catch(PDOException $e){
		echo "ERROR -> ".$e;
	}
?>