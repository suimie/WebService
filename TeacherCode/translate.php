<?php
//http://funtranslations.com/api#
// if we output the raw data it is in json format
header("Content-Type:application/json");

//base url of our web service
$base_url = "http://api.funtranslations.com/translate/";

//url that we are requesting
$url = $base_url . "minion";

//initialize the fetch command
$ch = curl_init($url);

//setup POST request options
curl_setopt($ch, CURLOPT_POST, 1); //request is POST
curl_setopt($ch, CURLOPT_POSTFIELDS, "text=Hello World"); //POST fields

//prevent automatic output to screen
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// in case of MAMP issues
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

//execute the fetch command
$results = curl_exec($ch);

//close curl request
curl_close($ch);

//convert your json string into an object
$data = json_decode($results);
print_r($data); //print out of the object









 ?>