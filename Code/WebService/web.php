<?php

//require_once $_SERVER['DOCUMENT_ROOT'] . '/WebService/functions.php';
require_once("functions.php");

// check for GET method
if($_SERVER['REQUEST_METHOD'] == "GET"){

    //$people = ["John", "Peter", "Simon", "Joe"];
    $people = array(
      array("id"=>2, "name"=>"John", "city"=>"Montreal"),
      array("id"=>3, "name"=>"Peter", "city"=>"Ottawa"),
      array("id"=>4, "name"=>"Simon", "city"=>"Quebec")
    );

    // is a user requested?
    $json_people = null;
    if(isset($_GET['id'])){
        // retrun information about user
        $user_found = false;

        $id = $_GET['id'];

        foreach ($people as $person) {
          if($person['id'] == $id){
            //$links = array("rel"=>"self", "href"=>"localhost:8080/webservice/web.php/1");
            $user_found = true;
            //$json_people = json_encode(array("people"=>$person, "Links"=>createLinks($id)));
            response(
              array("People"=>$person, "Links"=>createLinks($id))
            );
          }
        }

        if(!$user_found){
          /*
          $json_people = json_encode(
            array("Error"=>"User was not found", "Links"=>createLinks($id))
          );
          */
          response(
            array("Error"=>"User was not found", "Links"=>createLinks()),
            400
          );
        }
    }else{
        // return list of all suers
        /*
        $json_people = json_encode(array(
          "people"=>$people,
          "Links"=>createLinks()
        ));
        */
        response(
          array("People"=>$people, "Links"=>createLinks())
        );
    }// endif get user id

}else{
    // not GET, return error
    response(array("Error"=>"Method not found", "Links"=>createLinks()), 405);
}
?>
