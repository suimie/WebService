<?php

//include NuSOAP toolkit (https://sourceforge.net/projects/nusoap/)
require("lib/nusoap.php");

// Functions that act as method calls from web service
function stockPrice($stock_name){
  $stocks = array("IBM"=>12.99, "Apple"=>102.54, "FBOOK"=>"bad");
  foreach ($stocks as $name => $price){
    if ($stock_name == $name)
      return $price;
  }
  return -1;
}
function stockType($stock_name){
  $stocks = array("IBM"=>"Technology", "Apple"=>"Technology", "FBOOK"=>"Website");
  foreach ($stocks as $name => $type){
    if ($stock_name == $name)
      return $type;
  }
  return "null";
}


// initiate a new web service (using nuSoap)
$server = new soap_server();
$server->configureWSDL("server"); // configure WSDL

//register web service functions for wsdl
$server->register("stockPrice",
          array('stock_name'=>"xsd:string"),
          array('price'=>'xsd:decimal')
        );

$server->register("stockType",
          array('stock_name'=>"xsd:string"),
          array('type'=>'xsd:string')
        );

//start web service
$server->service(file_get_contents("php://input"));

 ?>