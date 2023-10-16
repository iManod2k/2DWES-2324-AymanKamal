<?php

	require "../funciones.php";
	
	
	

	$ip = explode(".",$_POST['ip_num'],4);
	$ip_binario = "";
	
	$bien = true;
	
	if(count($ip) != 4){
		$bien = false;
	}
	
	forEach($ip as $valor){
		if(is_numeric($valor) && ($valor >= 0 && $valor <= 255)){
			$ip_binario .= num_binarioIP($valor).".";
		}else {
			$bien = false;
			break 1;
		}
	}
	
	
	
	if($bien){
		$ip_binario = substr($ip_binario, (strlen($ip_binario)*-1), -1);
	
		echo "<html>
				<body>
					<h1>IPs</h1>
					
					<br><br>
					
					<form name='form_ip' action='ip.php' method='post'>
						<label for='ip'>IP Notación decimal:</label>
						<input name='ip_num' type='text' value=".$_POST['ip_num']."></input>
						<br><br>
						<label>IP Binario:</label>
						<label>".$ip_binario."</label>
						<br><br>
						<input type='submit' value='enviar'></input>
						<input type='reset' value='reset'></input>
					</form>
					
				</body>
				</html>";
	}else {
		echo "<html>
				<body>
					<h1>IPs</h1>
					
					<br><br>
					
					<form name='form_ip' action='ip.php' method='post'>
						<label for='ip'>IP Notación decimal:</label>
						<input name='ip_num' type='text' value=".$_POST['ip_num']."></input>
						<br><br>
						<label>IP Binario:</label>
						<label>¡ ERROR !</label>
						<br><br>
						<input type='submit' value='enviar'></input>
						<input type='reset' value='reset'></input>
					</form>
					
				</body>
				</html>";
	}
	
	
?>