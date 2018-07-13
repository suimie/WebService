<?php

require("functions.php");

// check for GET method
if ($_SERVER['REQUEST_METHOD']=="GET"){

  //$people = ["John","Peter","Simon","Joe"];
  $people = array(
      array("id"=>2, "name"=>"John", "city"=>"Montreal"),
      array("id"=>3, "name"=>"Peter", "city"=>"Ottawa"),
      array("id"=>4, "name"=>"Simon", "city"=>"Quebec")
  );

  //is a user requested?
  if (isset($_GET['id'])){
    //return information about user
    $user_found = false;

    foreach($people as $item){
      if ($_GET['id'] == $item['id']){
          $user_found = true;
          response(
            array("Person"=>$item, "Links"=>create_links('id='.$_GET['id']))
          );
      }
    }//enf foreach

    if(!$user_found){
      response(
          array("Error"=>"User was not found",
                "Links"=>create_links('id='.$_GET['id']) )
          ,400
        );
    }
  }else{
    //return list of all users
    //$links = array("rel"=>"self", "href"=>"http://localhost:8080/api/web.php");

    response(
      array("People"=>$people, "Links"=>create_links())
    );
  }//endif get user id

  //change header content type to respond as JSON
//  header("Content-Type:application/json");
//  echo $json_people;

}else{
  //not GET, return error
  echo "error";
}

?>
