<?php
	//Parametrso de conexion al servidor
	$servidor = "localhost";
	$usuarioSevidor="root";
	$passwordServidor= "";
	
	$base="agenda";
//realizar la conexion al servidor mysql
	$conexion = new mysqli($servidor, $usuarioSevidor, $passwordServidor);

	if (!$conexion->error){
		//crea la badatos 
		mysqli_query ($conexion,  "CREATE DATABASE IF NOT EXISTS agenda;");
		mysqli_select_db($conexion, $base);
        //creacion de tablas
		mysqli_query($conexion, "CREATE TABLE IF NOT EXISTS usuarios ( id integer primary key AUTO_INCREMENT  , 
								 email varchar (20) not null unique,
								 nombre varchar (50),
								 password varchar(250), 
								 fecha_nacimiento  date);
								");

		mysqli_query($conexion, "CREATE TABLE IF NOT EXISTS agenda ( id integer primary key AUTO_INCREMENT  , 
								 title varchar (20) not null unique,
								 start date,
								 start_hour  time, 
								 end  date, 
								 end_hour time,
								 allDay boolean,
								 fk_usuario integer);
								");
		
		$conexion = new mysqli($servidor, $usuarioSevidor, $passwordServidor, $base);
		$response["msg"] = "OK";
		include 'create_user.php';

	}else{
		echo 	$response["msg"] ="Error al tratar de acceder al servidor ";
	}


?>