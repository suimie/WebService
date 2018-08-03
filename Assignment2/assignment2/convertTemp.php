<?php

require("lib/nusoap.php");

function convertCelsiusToFahrenheit($celcius){
  return $celcius * 1.8 + 32;
}

function convertCelsiusToKelvin($celcius){
  return $celcius + 273.15;
}

function convertFahrenheitToCelsius($fahrenheit){
  return ($fahrenheit - 32) / 1.8;
}

function convertFahrenheitToKelvin($fahrenheit){
  return ($fahrenheit + 459.67) * (5/9);
}

function convertKelvinToCelsius($kelvin){
  return $kelvin - 273.15;
}

function convertKelvinToFahrenheit($kelvin){
  return $kelvin * (9 / 5) - 459.67;
}

$server = new soap_server();
$server->configureWSDL("server");

$server->register("convertCelsiusToFahrenheit",
                  array('celcius'=>"xsd:decimal"),
                  array('fahrenheit'=>'xsd:decimal')
                  );
$server->register("convertCelsiusToKelvin",
                  array('celcius'=>"xsd:decimal"),
                  array('kelvin'=>'xsd:decimal')
                  );
$server->register("convertFahrenheitToCelsius",
                  array('fahrenheit'=>"xsd:decimal"),
                  array('celcius'=>'xsd:decimal')
                  );
$server->register("convertFahrenheitToKelvin",
                  array('fahrenheit'=>"xsd:decimal"),
                  array('kelvin'=>'xsd:decimal')
                  );
$server->register("convertKelvinToCelsius",
                  array('kelvin'=>"xsd:decimal"),
                  array('celcius'=>'xsd:decimal')
                  );
$server->register("convertKelvinToFahrenheit",
                  array('kelvin'=>"xsd:decimal"),
                  array('fahrenheit'=>'xsd:decimal')
                  );

$server->service(file_get_contents("php://input"));


 ?>
