<HTML>
<HEAD><TITLE> EJ2B – Conversor Decimal a base n </TITLE></HEAD>
<BODY>
<?php
	$num="1515";
	$base="16";
	$resul = "";
	
	$bin_result = "";
	
	while($num > 1){
		
		switch($num%16){
			case 10:$resul = "A".$resul;break;
			case 11:$resul = "B".$resul;break;
			case 12:$resul = "C".$resul;break;
			case 13:$resul = "D".$resul;break;
			case 14:$resul = "E".$resul;break;
			case 15:$resul = "F".$resul;break;
			default:$resul = $num%$base."".$resul;break;
		}
		$num = $num / $base;
	}
	
	echo $resul;
		
?>
</BODY>
</HTML>