<?php
	$conexion = new mysqli("localhost", "root", "", "agenda");
	if ($conexion){
		session_start();
		if ($_SESSION['agendaID']){
			$eventos= mysqli_query($conexion, "SELECT * FROM agenda where fk_usuario = 1");
			$row_eventos = mysql_fetch_assoc($eventos);
			$php_reponse["eventos"]= array();

			do {
				$php_reponse["eventos"]['id']= $row_eventos['id'];	
				$php_reponse["eventos"]['title']=$row_eventos['titulo'];	
				$php_reponse["eventos"]['start']=$row_eventos['fecha_inicio'];	
			}	while ($row_eventos = mysql_fetch_assoc($eventos));
			

		}else{
			$php_reponse["msg"]="SESION VENCIDA";
		}
	
	}else{
		$php_reponse["msg"]="ERROR AL CONECTARSE AL SERVIDOR";

	}
	 print_r($php_reponse);
  	




 ?>
