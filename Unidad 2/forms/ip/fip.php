<html>
<body>
	<h1>IPs</h1>
	
	<br><br>
	
	<form name="form_ip" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<label for="ip">IP Notación decimal:</label>
		<input name="ip_num" type="text"></input>
		<br><br>
		<?php

	require "../funciones.php";
	
	
	
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$ip = explode(".",$_POST['ip_num'],4);
	$ip_binario = "";
	
	$bien = true;
	
	if(count($ip) <> 4){
		$bien = false;
	}else {
		forEach($ip as $valor){
			if(is_numeric($valor) && ($valor >= 0 && $valor <= 255)){
				$ip_binario .= num_binarioIP($valor).".";
			}else {
				break 1;
			}
		}
	}
	
	
	echo $bien;
	if($bien){
		$ip_binario = substr($ip_binario, (strlen($ip_binario)*-1), -1);
	
		echo "<label>IP Binario:</label>
						<label>".$ip_binario."</label>";
	}else {
		echo "MAL";
	}
}
	
?>
		<br><br>
		<input type="submit" value="enviar"></input>
		<input type="reset" value="reset"></input>
	</form>
	
</body>
</html>