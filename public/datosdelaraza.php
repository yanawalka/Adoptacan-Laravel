<?php
//header('Content-Type: application/json');

  $valida[] = array("raza" => $_GET["raza"],"metodo"=>$_GET["metodo"]);
  echo json_encode($valida);


 ?>
