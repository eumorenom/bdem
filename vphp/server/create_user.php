<?php
//crea usarios y base de datos
require_once "conexion.php";
if ($response["msg"]=="OK"){
	$u_exiten = mysqli_query($conexion, "SELECT * FROM usuarios");
	if (mysqli_num_rows($u_exiten) > 0 ){
		$response['obser']= "los usaurios ya existen ";
	
	}else{

		$email = "boy001@gmail.com";
		$nombre="Prueba1";
		$password =md5("123456");
		$fecha_nacimiento = "2000/01/08";
		$crear = $conexion->prepare("INSERT INTO usuarios (email, nombre, password, fecha_nacimiento) VALUES (?,?,?,?)"); 
		$crear->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);
		$crear->execute();

		$email = "boy002@gmail.com";
		$nombre="Prueba2 ";
		$password =md5("123456");
		$fecha_nacimiento = "2000/07/01";
		$crear->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);
		$crear->execute();



		$email = "prueba@gmail.com";
		$nombre="EUMoreno";
		$password =md5("123456");
		$fecha_nacimiento = "2000/09/08";
		$crear = $conexion->prepare("INSERT INTO usuarios (email, nombre, password, fecha_nacimiento) VALUES (?,?,?,?)"); 
		$crear->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);
		$crear->execute();

	}	
	$cumple = date('Y/m/d',strtotime("1982/07/08"));
	



}
