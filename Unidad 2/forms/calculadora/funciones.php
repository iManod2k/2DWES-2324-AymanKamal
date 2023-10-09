<?php
	function limpiar_data($data){
		echo "<br>funcion LIMPIAR_DATA";
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>