<?php
	
	$fichero = fopen("Ds_MerchantParameters.json", 'r');
	$contenido = fread($fichero, filesize("Ds_MerchantParameters.json"));

	echo $contenido;

?>