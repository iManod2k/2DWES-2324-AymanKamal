<HTML>
<HEAD><TITLE> EJ2B – Conversor Decimal a base n </TITLE></HEAD>
<BODY>
<?php
	$num="48";
	$base="6";
	$resul = "";
	
	$bin_result = "";
	
	while($num > 1){
		$resul = $num%$base."".$resul;
		$num = $num / $base;
	}
	
	echo $resul;
		
?>
</BODY>
</HTML>