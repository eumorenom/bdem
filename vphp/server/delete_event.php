<?php
//borra eventos de la tabla agenda
	require_once "conexion.php";
	if (!$conexion->error){
		session_start();
		if ($_SESSION['agendaID']){
			$id=$_POST["id"];
			$borrar= mysqli_query($conexion, "DELETE FROM  agenda where id =  '$id' ");
			$php_reponse["msg"]="OK";
			$php_reponse["extra"]=$_POST["id"];
			
		}else{
			$php_reponse["msg"]="NO TIENE SESION ABIERTA O CADUCO ";
		}
	
	}else{
		$php_reponse["msg"]="nO SE PUEDE CONECTAR AL SERVIDOR";

	}
	echo json_encode($php_reponse);


 ?>
