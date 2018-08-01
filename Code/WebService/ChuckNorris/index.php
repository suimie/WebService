<?php
//header("Content-Type:application/json");
$url = "https://api.chucknorris.io/jokes/categories";
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$results = curl_exec($ch);
curl_close($ch);

$data = json_decode($results);
//print_r($data);
 ?>
 <html>
     <head>
         <title>Chuck Norris API</title>
     </head>
     <body>
       <div>
         <h1>Categories</h1>
         <ul>
         <?php
         foreach($data as $item) : ?>
          <li><a href='chucknorris.php?category=<?= $item ?>'><?= $item ?></li></a>
       </ul>
       <?php endforeach;?>
       </div>

     </body>
 </html>
