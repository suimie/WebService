<?php

// creates the links required for ReST
function create_links($arg=""){

  if($arg != "") $arg = "?" . $arg;

  $links = array("rel"=>"self",
  "href"=>"http://localhost:8080/api/web.php" . $arg);

  return $links;
}

//responses
function response($data, $status=200){
  header("Content-Type:application/json");
  header("HTTP/1.1 " . $status);
  echo json_encode($data);
}

 ?>
