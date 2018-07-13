<?php

//creates the links required for ReST
function createLinks($arg=""){

  if($arg != "") $arg = "?id=" . $arg;


  $links = array("rel"=>"self", "href"=>"localhost:8080/webservice/web.php" . $arg);
  return $links;
}

// responses
function response($data, $status=200){
  if (isset($_GET['format'])){
    $format = $_GET['format'];
  }else{
    $format = 'json';
  }

  if($format == 'json'){
    // json format
    respond_as_json($data, $status);
  }else if ($format == 'xml'){
    // xml format
    respnd_as_xml($data, $status);
  }else{
    respond_as_json(array("Error"=>"Format should be xml or json", "Links"=>createLinks()), 406);
  }
}

function respond_as_json($data, $status=200){
  header("Content-Type:application/json");
  header("HTTP/1.1 " . $status);
  echo json_encode($data);
  die();
}

function respnd_as_xml($data, $status=200){
  header("Content-Type:text/xml");

  // function call to convert array to xmlrpc_decode$xml_data = array_to_xml($data);
  $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
  array_to_xml($data, $xml_data);
  print $xml_data->asXML();
}

function array_to_xml($data, &$xml_data){
    foreach($data as $key => $value){
        if(is_numeric($key)){
          $key = 'item';  //$key
        }
        if(is_array($value)){
          $subnode = $xml_data->addChild($key);
          array_to_xml($value, $subnode);
        }else{
          $xml_data->addChild("$key", htmlspecialchars("$value"));
        }
    }
}
?>
