<?php
	function limpiar_data($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function verificarEmail($valor){
		return preg_match("/^[a-zA-Z0-9-_.]+[@][a-zA-Z]{2,5}[.](com|es)$/",$valor);
	}
	function verificarNombreApellidos($valor){
		if(strlen($valor)){
			return preg_match("/^[a-zA-Z ]{1,}$/",$valor);
		}else {
			return false;
		}
	}
	
	
	
	
	function isFormatoCorrecto($array) {
		return is_numeric($array[0].$array[1]);
	}
	function convertirBase($numero, $base){
		$resul = "";
		while($numero > 1){
			$resul = ($numero%$base)."".$resul;
			$numero/=$base;
		}
		return (int)$resul;
	}
	
	function num_binarioIP($valor){
		
		return str_pad(sprintf("%b", $valor), 8, "0", STR_PAD_LEFT);
	}
?>