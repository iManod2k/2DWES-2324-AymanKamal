<?php

$conn = conexionBBDD();

function conexionBBDD(){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "webemple";

	$conn = new PDO("mysql:host=$servername;dbname=".$dbname,$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	echo "Conectado";

	return $conn;
}



function select($sentencia){

	global $conn;

	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = $sentencia;

	$stmt = $conn -> prepare($sql);
	$stmt -> execute();

	$stmt -> setFetchMode(PDO::FETCH_ASSOC);

	return $stmt -> fetchAll();
}



function altaDpto($nombre_dpto){

	global $conn;


	$resul = select("SELECT MAX(cod_dpto) as cod_dpto FROM departamento");


	$codigo_numerico_aumentado = intval(substr($resul[0]["cod_dpto"], -3)) + 1; // Cojo los ultimos 3 caracteres (los numeritos) y le sumamos 1
	$codigo_nuevo = "D".str_pad($codigo_numerico_aumentado, 3, "0", STR_PAD_LEFT);

	// CONTINUAR - doy de Alta


	if(strlen($nombre_dpto) > 0){

		$sql_insert = "INSERT INTO departamento (cod_dpto, nombre_dpto) VALUES (:cod_dpto, :nombre_dpto);";
		$stmt_insert = $conn -> prepare($sql_insert);

		$stmt_insert -> bindParam(':cod_dpto', $codigo_nuevo);
		$stmt_insert -> bindParam(':nombre_dpto', $nombre_dpto);

		$stmt_insert -> execute();
	}else {

		echo "Error - Nombre vacio";
	}

}



function altaEmpleado($dni, $nombre, $apellidos, $fecha_nac, $salario, $cod_dpto){

	global $conn;
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql_insert = "INSERT INTO empleado (dni,nombre,apellidos,fecha_nac,salario) VALUES (:dni,:nombre,:apellidos,:fecha_nac,:salario);";

	$stmt_insert = $conn -> prepare($sql_insert);


	$stmt_insert -> bindParam(':dni', $dni);
	$stmt_insert -> bindParam(':nombre', $nombre);
	$stmt_insert -> bindParam(':apellidos', $apellidos);
	$stmt_insert -> bindParam(':fecha_nac', $fecha_nac);
	$stmt_insert -> bindParam(':salario', $salario);

	try{
		$stmt_insert -> execute();
		// Si ocurre algun error, no sigue

	}catch(PDOException $Exception){

		if($Exception -> getCode() === "23000"){
			echo "Error ! DNI Duplicado";
		}else {
			echo "Error diferente...";
		}
	}
}



function asignarEmpleadoAdep($dni, $cod_dpto, $fecha_ini, $fecha_fin){

	// $resul = select("SELECT * FROM emple_depart WHERE \"".$dni."\" = dni");
	$resul = select("SELECT * FROM emple_depart WHERE \"".$dni."\" = dni AND cod_dpto != \"".$cod_dpto."\" ");

	global $conn;


	if(count($resul) == 0){
		echo "No hay"; // Se añade el Empleado a emple_depart si NO se encuentra en la tabla Y dispone de distinto trabajo

		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql_insert = "INSERT INTO emple_depart (dni,cod_dpto,fecha_ini,fecha_fin) VALUES (:dni,:cod_dpto,:fecha_ini,:fecha_fin);";

		$stmt_insert = $conn -> prepare($sql_insert);


		$stmt_insert -> bindParam(':dni', $dni);
		$stmt_insert -> bindParam(':cod_dpto', $cod_dpto);
		$stmt_insert -> bindParam(':fecha_ini', $fecha_ini);
		$stmt_insert -> bindParam(':fecha_fin', $fecha_fin);

		$stmt_insert -> execute();
	}else {
		echo "Si hay, actualizando"; // Si existe, actualizo el registro anterior (fecha_fin) Y LUEGO meto el nuevo (trabajo)


		$sql_update = "UPDATE emple_depart  SET fecha_fin = :fecha_ini WHERE dni = :dni AND fecha_fin = ''";


		$stmt_update = $conn -> prepare($sql_update);

		$stmt_update -> bindParam(':fecha_ini', $fecha_ini);
		$stmt_update -> bindParam(':dni', $dni);

		$stmt_update -> execute();




		echo "actualisando";

		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql_insert = "INSERT INTO emple_depart (dni,cod_dpto,fecha_ini,fecha_fin) VALUES (:dni,:cod_dpto,:fecha_ini,:fecha_fin);";

		$stmt_insert = $conn -> prepare($sql_insert);


		$stmt_insert -> bindParam(':dni', $dni);
		$stmt_insert -> bindParam(':cod_dpto', $cod_dpto);
		$stmt_insert -> bindParam(':fecha_ini', $fecha_ini);
		$stmt_insert -> bindParam(':fecha_fin', $fecha_fin);

		$stmt_insert -> execute();
	}

}




?>