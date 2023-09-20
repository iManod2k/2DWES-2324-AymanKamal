<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
	
	$numero = "127";
	$n = $numero;
	$bin_result = "";
	
	while($numero >= 1){
		$bin_result = ($numero%2).$bin_result;
		$numero = $numero / 2;
		
	}
	 echo $n." -> ".$bin_result . " con bucle";
?>
</BODY>
</HTML>
