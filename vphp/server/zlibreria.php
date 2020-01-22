<?php
 function guardar_log($numero,$texto)
{ 
    $i = 0;
	$ddf = fopen('zlog01.log','a'); 
	fwrite($ddf,"[".date("r")."] Error $numero:$texto\r\n"); 
	fclose($ddf); 
    if ($texto > " ") {
        $i = 1;
      }
    return ($i);

} 

function  listar_arregloAsoc ($nombreArreglo,$arr01)
    
{    
    echo "<br />- Enta a listar arreglo  ". $nombreArreglo;
	$txt = "<br />- Enta a listar arreglo  ". $nombreArreglo;
	guardar_log($nombreArreglo,$txt);
    $i = 0;
	foreach($arr01 as $v_arr01_c => $v_valor_arr01_v)
	{
		   echo "<br />- ". $v_arr01_c ." = ". $v_valor_arr01_v;
		$txt = "<br />- ". $v_arr01_c ." = ". $v_valor_arr01_v;
        $i = $i + 1;
		guardar_log($nombreArreglo,$txt);
	
		
	
	}
   return ($i);
}

 ?>

