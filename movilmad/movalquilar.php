<?php
	session_start();


	if( isset($_SESSION['carrito'])  ){
		var_dump($_SESSION['carrito']);
	}

	require ("views/view_alquilar.php");
	
	
?>
<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - ALQUILAR VEHÍCULOS</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="controllers/contr_alquilar.php" method="post">
	
		<B>Bienvenido/a: <?php username(); ?></B>  <BR><BR>
		<B>Identificador Cliente: <?php id_client(); ?></B>   <BR><BR>
		
		<B>Vehiculos disponibles en este momento: <?php free_vehicles_count(); ?></B>  <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B>
			<select name="vehiculos" class="form-control">
				<?php free_vehicles(); ?>
			</select>
			
		
		<BR> <BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
  </body>
   
</html>

