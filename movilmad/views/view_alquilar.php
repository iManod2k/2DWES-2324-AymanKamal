<?php

	include("./models/db_connexion.php");

	$conn = new Database();


	function date_time(){

		return date("d-m-Y h-m");
	}

	function username(){
		echo $nombre = $_SESSION['info_user']['nombre']." ".$_SESSION['info_user']['apellido'];
	}

	function id_client(){
		echo $id = $_SESSION['info_user']['idcliente'];
	}

	function free_vehicles(){
		global $conn;

		$cars = $conn -> cars_free();

		$options = "";

		for($f=0; $f<count($cars); $f++){

			$options .= sprintf("<option value='%s'>%s</option>", $cars[$f]['matricula'], $cars[$f]['matricula']);
		}


		echo $options;
	}


	function free_vehicles_count(){
		global $conn;

		$cars = $conn -> cars_free();

		echo count($cars)." ## ".date_time();
	}






?>