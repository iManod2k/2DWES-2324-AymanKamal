<?php
	

	// Recopilo información del JSON

	$fichero_json = file_get_contents("Ds_MerchantParameters.json");
	$datos_json = json_decode($fichero_json, true);
	
		// Modifico si eso...

	$guardar_json = json_encode($datos_json, JSON_PRETTY_PRINT);
	$guardar_crypt = base64_encode($guardar_json);
		// Vuelvo a guardar la info y encripto

	echo "Información Encriptada: <br>";
	printf($guardar_crypt);


	echo "<br><br>Clave de Comercio Encriptada (genérica): <br>";
	printf("sq7HjrUOBfKmC576ILgskD5srU870gJ7");

	echo "<br><br>Merchant Order (encriptado) del JSON (necesario para encriptarlo y juntarlo con la CLAVE COMERCIO): <br>";
	printf(base64_encode("1446068581"));
	
	echo "<br><br>Encriptado 3DES:<br>";
	// $des3 = openssl_encrypt("sq7HjrUOBfKmC576ILgskD5srU870gJ7", 'DES-EDE3', base64_encode("1446068581"), OPENSSL_RAW_DATA);
	$des3 = openssl_encrypt( base64_encode("1446068581"), 'DES-EDE3', "sq7HjrUOBfKmC576ILgskD5srU870gJ7", OPENSSL_RAW_DATA);
	$des3_texto_cifrado = base64_encode($des3);
	echo $des3_texto_cifrado;
	// sq7HjrUOBfKmC576ILgskD5srU870gJ7
?>