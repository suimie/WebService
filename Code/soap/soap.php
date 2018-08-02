<?php

require("lib/nusoap.php");

function stockPrice($stock_name){

  $stocks = array("IBM"=>12.99, "Apple"=>102.54, "FBOOK"=>.99);

  foreach($stocks as $name => $price){
    if($stock_name == $name)
      return $price;
  }

  return -1;
}



$server = new soap_server();
$server->configureWSDL("server");

$server->register("stockPrice",
                  array('stock_name'=>"xsd:string"),
                  array('price'=>'xsd:decimal')
                  );


$server->service(file_get_contents("php://input"));


 ?>
