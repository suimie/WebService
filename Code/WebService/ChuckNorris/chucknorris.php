<?php
//header("Content-Type:application/json");
$url = "";
$category = "";
if(isset($_GET) && isset($_GET['category'])){
  $category = $_GET['category'];
  $url = "https://api.chucknorris.io/jokes/random?category=" .$category;
}else{
  $url = "https://api.chucknorris.io/jokes/random";
}
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$results = curl_exec($ch);
curl_close($ch);

$randomjoke = json_decode($results);
//print_r($data->icon_url);
 ?>
 <html>
     <head>
         <title>Chuck Norris API</title>
     </head>
     <body>
       <div>
         <?php if($category!=null && $category !="") echo '<h1>Category : ' . $category . '</h1>' ?>
         <img src='<?= $randomjoke->icon_url?>'>
         <h1><?= $randomjoke->value ?></h1>
       </div>

     </body>
 </html>
