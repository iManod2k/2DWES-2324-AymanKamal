<HTML>
<HEAD>
<TITLE> EJ2B – Conversor Decimal a base n </TITLE>
<STYLE>
table{
	border-spacing:0;
}
td {
  border: 1px solid black;
}
</STYLE>
</HEAD>
<BODY>
	<TABLE>
		<?php
			$num=8;
			for($cont=1; $cont<=10; $cont++){
				echo "<tr>";
					echo "<td>";
						echo $num." X ".$cont;
					echo "</td>";
					echo "<td>";
						echo ($num*$cont);
					echo "</td>";
				echo "</tr>";
			}	
		?>
	</TABLE>

</BODY>
</HTML>