<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - EPATIN</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
      
<body>
    <h1>ALQUILER PATINETES ELÉCTRICOS</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Login Usuario</div>
		<div class="card-body">
		
		<form id="" name="" action="" method="post" class="card-body">
		
		<div class="form-group">
			Email <input type="text" name="email" placeholder="email" class="form-control">
        </div>
		<div class="form-group">
			Clave <input type="password" name="password" placeholder="password" class="form-control">
        </div>				
        
		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>
		
	    </div>
    </div>
    </div>
    </div>

</body>
</html>

<?php
	//Llamamos a las funciones del fichero funciones.php
	include("efunciones.php");

	//Si pulsamos submit hara lo siguiente.
	if(isset($_POST["submit"])){
		
		//Guarda las variables
		$email = $_POST["email"];
		
		$password = $_POST["password"];
		
		//echo $email . "<br>" . $password;
		
		//Llama a la siguiente funcion, esta funcion le dirige al siguiente fichero si se loguea bien.
		get_login($email,$password,conexion());
		
	}

?>