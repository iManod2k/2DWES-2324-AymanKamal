<?php
	
	$ip = "192.18.16.204";
	$ip_partida = explode(".", $ip); //Convierto el String en Arrays

	// Creo un nuevo String convirtiendo CADA numero en BINARIO y lo parto en ARRAY
	$ip_binario = sprintf("%b.%b.%b.%b", $ip_partida[0], $ip_partida[1], $ip_partida[2], $ip_partida[3]);
	$ip_binario_partida = explode(".", $ip_binario);
	$ip_binario_result = "";
	
	
	// Relleno cada Cuarteto de BINARIOS con 0s hasta llegar a un 8 bits
	for($i = 0; $i<4; $i++){
		$ip_binario_partida[$i] = str_pad($ip_binario_partida[$i], 8, "0", STR_PAD_LEFT);
		$ip_binario_result = $ip_binario_result.".".$ip_binario_partida[$i];
	}
	
	$ip_binario_result = substr($ip_binario_result, 1); // Quito el punto sobrante
	
	printf($ip_binario_result);
	//print($ip_partida[0]);
	
?>