<?php
	function limpiar_data($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
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
?>