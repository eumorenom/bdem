<?php
	require_once "conexion.php";
	if (!$conexion->error){
		session_start();
		if (!$_SESSION['agendaID']){
			$response['msg']= "SESION CADUCADA ";

		}else{
			$id = $_SESSION['agendaID'];
	  	
	  		
			$consulta = "SELECT * FROM agenda WHERE fk_usuario = '$id'" ;
			if ($resultado = mysqli_query($conexion, $consulta)) {
			    while ($obj = mysqli_fetch_object($resultado)) {
					$response["eventos"][]= $obj;
			    }			
			    
			    mysqli_free_result($resultado);
			}									
		}



	}else{
		$response['msg']= "ERROR DE CONEXION AL SERVIDOR" ;
	}
	echo json_encode($response);

 ?>
