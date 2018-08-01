<?php
// if we output the raw data it is in json format
header("Content-Type:application/json");

//base url of our web service
$base_url = "https://swapi.co/api/";

//url that we are requesting
$url = $base_url . "vehicles/?page=2";

//initialize the fetch command
$ch = curl_init($url);

//prevent automatic output to screen
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
// in case of MAMP issues
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

//execute the fetch command
$results = curl_exec($ch);

//close curl request
curl_close($ch);

// print_r($results); // if you wanted to print out the raw data

//convert your json string into an object
$data = json_decode($results);
//print_r($data); //print out of the object

echo "Number of vehicles : " . $data->count . '<br /><br />';

// will only display results for the url we requested
foreach ($data->results as $item){
  echo $item->name . '<br />';
}









 ?>