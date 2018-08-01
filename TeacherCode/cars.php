<?php
//base url of our web service
$base_url = "https://swapi.co/api/";

//function that handles all the curl requests
function fetch_curl($url){
  $ch = curl_init($url); //initialize the fetch command

  //prevent automatic output to screen
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  // in case of MAMP issues
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

  $results = curl_exec($ch); //execute the fetch command
  curl_close($ch); //close curl request

  $data = json_decode($results);

  return $data;

}

// BAD BAD BAD BAD BAD - I can't say it enough BAD!!!!!
/*
$url = $base_url . "vehicles/?page=1";
$data = fetch_curl($url);
foreach ($data->results as $item){
 echo $item->name . '<br />';
}
$url = $base_url . "vehicles/?page=2";
$data = fetch_curl($url);
foreach ($data->results as $item){
 echo $item->name . '<br />';
}
$url = $base_url . "vehicles/?page=3";
$data = fetch_curl($url);
foreach ($data->results as $item){
 echo $item->name . '<br />';
}
$url = $base_url . "vehicles/?page=4";
$data = fetch_curl($url);
foreach ($data->results as $item){
 echo $item->name . '<br />';
}
*/

// better - but only good if you konw how many vehicles there are!
/*
for( $i=1; $i<=4; $i++ ){
  $url = $base_url . "vehicles/?page=" . $i;

  $data = fetch_curl($url);
  foreach ($data->results as $item){
   echo $item->name . '<br />';
  }
}
*/

//better because we don't need to know how many pages there are!
$i = 1;
do{
  $url = $base_url . "vehicles/?page=" . $i;

  $data = fetch_curl($url);

  foreach ($data->results as $item){
    if ( isset( $item->name ) )
      echo $item->name . '<br />';
    else
      echo $item->title . '<br />';
  }
  $i++;
}while($data->next != NULL)










 ?>