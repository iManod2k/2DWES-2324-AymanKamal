<?php
	echo "<h1>CONVERSOR NUMERICO</h1>";
	
	$numero_dec = (int)$_POST['num_dec'];
	$conversion = $_POST['tipo'];
	
	$celda="";
	$fila="";
	
	echo "<label>Numero Decimal</label>";
	echo sprintf("<input name=\"num_dec\" type=\"number\" value=\"%s\"></input>", $numero_dec);
	echo "<br><br>";
	
	switch($conversion){
		case "bin" : $celda = sprintf("<td>Binario</td><td>%b</td>", $numero_dec); $fila .= sprintf("<tr>%s</tr>", $celda);  break;
		case "oct" : $celda = sprintf("<td>Octal</td><td>%o</td>", $numero_dec); $fila .= sprintf("<tr>%s</tr>", $celda); break;
		case "hex" : $celda = sprintf("<td>Hexadecimal</td><td>%X</td>", $numero_dec); $fila .= sprintf("<tr>%s</tr>", $celda); break;
		case "todo" : 
			$celda = sprintf("<td>Binario</td><td>%b</td>", $numero_dec); $fila .= sprintf("<tr>%s</tr>", $celda);
			$celda = sprintf("<td>Octal</td><td>%o</td>", $numero_dec); $fila .= sprintf("<tr>%s</tr>", $celda);
			$celda = sprintf("<td>Hexadecimal</td><td>%X</td>", $numero_dec); $fila .= sprintf("<tr>%s</tr>", $celda);
		break;
	}
	
	$tabla = sprintf("<table>%s</table>", $fila);
	
	echo $tabla;
	
	
	//echo sprintf("<td>%b</td>", $numero_dec);
?>