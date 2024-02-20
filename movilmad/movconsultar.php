<?php
	session_start();

	$nombre = $_SESSION['info_user']['nombre']." ".$_SESSION['info_user']['apellido'];
	$id = $_SESSION['info_user']['idcliente'];
	
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
		<div class="card-header">Menú Usuario - CONSULTA ALQUILERES </div>
		<div class="card-body">
	  
	  	
	   

	<!-- INICIO DEL FORMULARIO -->
	<!-- <form action="controllers/contr_consultar.php" method="post"> -->
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				
		<B>Bienvenido/a: <?php echo $nombre; ?></B>   <BR><BR>
		<B>Identificador Cliente: <?php echo $id; ?></B> <BR><BR>
		     
			 Fecha Desde: <input type='date' name='fechadesde' value='2024-02-15' size=10 placeholder="fechadesde" class="form-control">
			 Fecha Hasta: <input type='date' name='fechahasta' value='2024-02-17' size=10 placeholder="fechahasta" class="form-control"><br><br>
				
		<div>
			<input type="submit" value="Consultar" name="Consultar" class="btn btn-warning disabled">
		
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
		
			<?php
			require("./views/view_consultar.php");
			require("./models/db_connexion.php");

						if( isset($_POST['Consultar']) ){
							$id = $_SESSION['info_user']['idcliente'];
							$fechadesde = $_POST['fechadesde'];
							$fechahasta = $_POST['fechahasta'];
							
			

							$conn = new Database();

							$cars = $conn -> get_cars_Date($id, $fechadesde, $fechahasta);

							for($i=0; $i<count($cars); $i++){

								show_cars($cars[$i]);
							}

						}



						if( isset($_POST['Volver']) ){
							header("Location: movwelcome.php");
						}
			?>
		</div>
	</form>
	<!-- FIN DEL FORMULARIO -->
    <a href = "">Cerrar Sesion</a>

  </body>
   
</html>
