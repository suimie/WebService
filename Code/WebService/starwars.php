<?php
//header("Content-Type:application/json");

$base_url = "https://swapi.co/api/";

$url = $base_url . "vehicles/?page=2";  //"planets/4/"; //"people/1/";  // "hello";

$ch = curl_init($url);
//prevent automatic output to screen
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


$results = curl_exec($ch);
curl_close($ch);

//print_r($results);

$data = json_decode($results);

echo "Number of vehicles : " . $data->count;
//print_r($data->count);
echo "<br />";

foreach($data->results as $item){
  echo $item->name . "<br />";
  //print_r($item);
  //echo "<br/>";
}

//print_r($data);
 ?>
