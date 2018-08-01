<?php

// creates the links required for ReST
function create_links($arg=""){

  if($arg != "") $arg = "?" . $arg;

  $links = array("rel"=>"self",
  "href"=>"http://localhost:8080/api/web.php" . $arg);

  return $links;
}

//handles responses
function response($data, $status=200){

  if (isset($_GET['format'])){
    if ($_GET['format'] == "xml")
      respond_as_xml($data, $status);
    elseif ($_GET['format'] == "json")
      respond_as_json($data, $status);
    else {
      $links = isset($data['Links']) ? $data['Links'] : array();
      respond_as_json(array("Error"=>"Unknown Format", "Links"=>$links),400);
    }
  }else{
    respond_as_json($data, $status);
  }
}
//returns response as json
function respond_as_json($data, $status){
  header("Content-Type:application/json");
  header("HTTP/1.1 " . $status);
  echo json_encode($data);
  die();
}
//returns response as XML
function respond_as_xml($data, $status){
  header("Content-Type:text/xml");
  header("HTTP/1.1 " . $status);

  $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
  array_to_xml($data, $xml_data);
  print $xml_data->asXML();

}

//converts array into xml
function array_to_xml( $data, &$xml_data ) {
  //https://stackoverflow.com/a/5965940
    foreach( $data as $key => $value ) {
        if( is_numeric($key) ){
            $key = 'item';//.$key;
        }
        if( is_array($value) ) {
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}

?>