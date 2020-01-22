<?php
	require_once "conexion.php";
	if (!$conexion->error){
		session_start();
		if ($_SESSION['agendaID']){
			$fk_usuario = $_SESSION['agendaID']; 
			$titulo	= $_POST['titulo']; 
			$fecha_inicio	=$_POST['start_date']; 
			$hora_inicio	=$_POST['start_hour'];	
			$fecha_fin	=$_POST['end_date'];
			$hora_fin	=$_POST['end_hour'];
			$dia	=$_POST['allDay']; 
			$php_reponse['msg']="OK";

			$add_evento = mysqli_query($conexion, "INSERT INTO agenda (title, start, start_hour, end, end_hour, allDay, fk_usuario) VALUES ('$titulo','$fecha_inicio', '$hora_inicio', '$fecha_fin', '$hora_fin', $dia, $fk_usuario)") ;

			$php_reponse["id"]=$conexion->insert_id;

		}else{
			$php_reponse["msg"]="SESION INVALIDA";
		}
	
	}else{
		$php_reponse["msg"]="ERROR AL CONECTARSE AL SERVIDOR";

	}
	echo json_encode($php_reponse);
  	
	$conexion->close();

 ?>
