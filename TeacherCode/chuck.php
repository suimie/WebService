<?php //https://api.chucknorris.io/
//base url of our web service
$base_url = "https://api.chucknorris.io/jokes/";

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

  //decode JSON that is returned
  $data = json_decode($results);

  return $data;
}

//request for all the category
$categories = fetch_curl($base_url . 'categories');
//save current category in $cat_search variable (used below)
$cat_search = ($_SERVER['REQUEST_METHOD'] == "POST") ? $_POST['cat'] : "";

 ?><!DOCTYPE html>
 <html lang="en">
<head>
  <title>Chuck Norris</title>
</head>
<body>
  <h1>Random Chuck Norris Facts</h1>
  <p>Select a category to view a random fact about Chuck Norris</p>

<!-- Create form that lists all the categories and POST value to get fact -->
<form method="post">
  <select name="cat">
    <option value="">---</option>
    <?php foreach ($categories as $category){ ?>
      <option value="<?= $category; ?>" <?= $cat_search==$category?"selected":""; ?> ><?=$category; ?></option>
    <?php }//endloop categories dropdown ?>
  </select>
  <input type="submit" />
</form>
<hr />
<!-- Show the fact if form was submmited -->
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  //check that category is in the list
  if (in_array($cat_search, $categories)){
    // request a random fact for selected category
    $chuck = fetch_curl($base_url . 'random?category='.$_POST['cat']);

    //display category as title if there is a category
    if (!empty($chuck->category)){
      echo "<h3>";
      foreach ($chuck->category as $i =>$c) echo ($i!=0?", ":"") . ucfirst($c);
      echo "</h3>";
    } //endif !empty categories

    //display information about the random fact
    echo "<img src='$chuck->icon_url' style='float:left' alt='Chuck Norris Facts' />";
    echo $chuck->value;

  } //endif in_array()

}//endif POST request method
?>
</body>

 </html>