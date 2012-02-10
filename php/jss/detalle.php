<?php
  include_once "/url_funcion_conexion/conexion.php";
  $nomb = $conn->getOne("select namefield from tablename where namefield_key = $cvee");
  if(trim($nomb) == "") $nomb = "<font color=red>NO Existe detalle para esa clave</font>";
?>
<div><big> <?=$nomb?> </big></div>