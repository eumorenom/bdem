<?php

	require "conexion.php";

	if (!$conexion->error){
		$user=$_POST['username'] ; 
		//encripcion
		$pass=md5($_POST['password']) ;
		//conexion a la base de datos
		$result = mysqli_query($conexion,  "SELECT * FROM usuarios WHERE  email  = '".$user."' and password= '".$pass."'") ;
		$row_result = mysqli_fetch_array($result);

		if ($row_result){
			session_start();
			$_SESSION["agendaID"] = $row_result['id'];
			$_SESSION["agendaUser"] = $row_result['email'];
			$response['msg']="OK";
		}else{
			$response["msg"]= " INVALIDOS USUARIO O CONTRASEÑA";
		}
	}else{
		$response["msg"]= "NO SE PUDO CONECTARA LA b.dATOS ";
	}
	
	echo json_encode($response);
	$conexion->close();
?>
