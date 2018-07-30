<?php

function fetch_curl($url){

  $ch = curl_init($url);
  //prevent automatic output to screen
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  // in case of MAMMP issues
  //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


  $results = curl_exec($ch);
  curl_close($ch);

  //print_r($results);

  $data = json_decode($results);


  return $data;
}

$base_url = "https://swapi.co/api/";


$i = 1;
do{
  $url = $base_url . "people/?page=" . $i;

  $data = fetch_curl($url);

  foreach($data->results as $item){
    if (isset($item->name))
      echo $item->name . "<br />";
    else    // case of film(it doesn't have name field)
      echo $item->title . "<br />";
  }
  $i++;
}while($data->next != NULL);

?>
