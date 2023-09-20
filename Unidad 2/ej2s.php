<?php
	
	$ip = "192.18.16.204";
	$ip_binario = substr(ip_a_binario($ip), 1);
	// Obtengo la IP y quito el primer "." que me sobra
	
	print($ip_binario);
	
	
	
	
	
	
	
	
	
	
	 function ip_a_binario($direccion_ip){
		 
		 $ip_partida = explode(".", $direccion_ip);
		 $numero_binario = "";
		 
		 foreach($ip_partida as $numero){
			 $numero_binario_buffer = "";
			 while($numero >= 1){ // Calculo el binario del numero
				 $numero_binario_buffer = ($numero%2)."".$numero_binario_buffer;
				 $numero /= 2;
			 }
			 
			 while(strlen($numero_binario_buffer) < 8){ // Relleno de 0s hasta que sea de tamaño 8 el Binario
				$numero_binario_buffer = "0".$numero_binario_buffer;
			 }
			 
			 // Junta en un String final cada "trozo" de Binario
			 $numero_binario = $numero_binario.".".$numero_binario_buffer;
		 }
		 
		 return $numero_binario;
	 }
?>