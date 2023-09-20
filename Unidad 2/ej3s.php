<?php
	
	$ip = "192.168.16.100/21";
	$ip_binario = ip_a_binario($ip);
	
	$mascara = explode("/", $ip)[1]; // Cojo solo el segundo elemento, el numero de Mascara
	
	// IMPORTANTE -> Tamaño Negativo !!!
	// Aqui, en binario, cojo la parte de RED y la de EQUIPOS la pongo TODO a 0s. Luego la transformo a IP
	$dir_red_bin = substr($ip_binario,0,($mascara-32)).str_repeat("0", 32-$mascara);
	$dir_red_bin_partida = str_split($dir_red_bin,8);
	$dir_red = binario_a_ip($dir_red_bin_partida);
	
	
	// IMPORTANTE -> Tamaño Negativo !!!
	// Aqui lo mismo, solo que en vez de 0s lo hago a 1s. Lo transformo a IP
	$dir_broadcast_bin = substr($ip_binario,0,($mascara-32)).str_repeat("1", 32-$mascara); // Cojo el primer "cacho" de RED y el resto a 1s
	$dir_broadcast_bin_partida = str_split($dir_broadcast_bin,8); // lo parto en trozos 4 trozos de 8
	$dir_broadcast = binario_a_ip($dir_broadcast_bin_partida);
	
	
	
	print("IP ".$ip);
	print("</br>");
	print("Mascara ".$mascara);
	print("</br>");
	print("Direccion Red ".$dir_red);
	print("</br>");
	print("Direccion Broadcast ".$dir_broadcast);
	print("</br>");
	
	// Reutilizo las variables y las cambio ligeramente para indicar la Primera y Ultima usable
	$dir_red_bin_partida[3][7] = "1"; // RED + 1 = Primero usable
	$dir_broadcast_bin_partida[3][7] = "0"; // BROADCAST - 1 = ULTIMO USABLE
	
	$primera_ip_usable = binario_a_ip($dir_red_bin_partida);
	$ultimma_ip_usable = binario_a_ip($dir_broadcast_bin_partida);
	print("Rango de ".$primera_ip_usable." hasta ".$ultimma_ip_usable);
	
	
	
	
	
	
	
	function binario_a_ip($bin){
		return bindec($bin[0]).".".bindec($bin[1]).".".bindec($bin[2]).".".bindec($bin[3]);
	}
	
	
	function ip_a_binario($ip){
		$ip_partida = explode(".", $ip); //Convierto el String en Arrays

		// Creo un nuevo String convirtiendo CADA numero en BINARIO y lo parto en ARRAY
		$ip_binario = sprintf("%b.%b.%b.%b", $ip_partida[0], $ip_partida[1], $ip_partida[2], $ip_partida[3]);
		$ip_binario_partida = explode(".", $ip_binario);
		$ip_binario_result = "";
		
		
		// Relleno cada Cuarteto de BINARIOS con 0s hasta llegar a un 8 bits
		for($i = 0; $i<4; $i++){
			$ip_binario_partida[$i] = str_pad($ip_binario_partida[$i], 8, "0", STR_PAD_LEFT);
			$ip_binario_result = $ip_binario_result.$ip_binario_partida[$i];
		}
		
		return $ip_binario_result;
	}
	
?>