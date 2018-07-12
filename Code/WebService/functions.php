<?php

//creates the links required for ReST
function createLinks($arg=""){

  if($arg != "") $arg = "?id=" . $arg;


  $links = array("rel"=>"self", "href"=>"localhost:8080/webservice/web.php" . $arg);
  return $links;
}

// responses
function response($data, $status=200){
  header("Content-Type:application/json");
  header("HTTP/1.1 " . $status);
  echo json_encode($data);
}
?>
