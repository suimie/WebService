<?php
//https://msdn.microsoft.com/en-us/library/ff701714.aspx

//setup variables for requests
$api_key = "YOUR_API_KEY_HERE";
$country = "CA";
$province = "QC";
$city = "Montreal";
$address = urlencode("275 Notre-Dame East"); //encode to prevent spaces in URL = errors
$postalCode = "H2Y1C6";

//setup structured url for request
$url_structured = "http://dev.virtualearth.net/REST/v1/Locations/" . $country . "/"
  . $province . "/"
  . $postalCode ."/"
  . $city . "/"
  . $address . "?"
  . "key=" . $api_key;

//setup unstructured url for request
$url_unstructured = "http://dev.virtualearth.net/REST/v1/Locations?"
  . "countryRegion=" . $country . "&"
  . "adminDistrict=" . $province . "&"
  . "locality=" . $city . "&"
  . "postalCode=" . $postalCode . "&"
  . "addressLine=" . $address . "&"
  . "key=" . $api_key;


$url = $url_structured;
//$url .= "$o=xml"; // change output to XML
//initialize the CURL request
$ch = curl_init($url_structured);

//setup curl options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //prevent output on curl execution
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // in case of MAMP issues
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // in case of MAMP issues

//execute CURL request
$results = curl_exec($ch);
//close CURL handler
curl_close($ch);

// print_r($results);
$data = json_decode($results);

//get the coordinates
$cp = $data->resourceSets[0]->resources[0]->point->coordinates;

print_r($cp);

?><!DOCTYPE html>
<html>
<head>
  <title>Hello Bing</title>
</head>
<body>
  <p>
    Show map of the location we fetched using the Bing Map API
  </p>
  <div>
       <iframe width="500" height="400" frameborder="0" src="https://www.bing.com/maps/embed?h=400&w=500&cp=<?= $cp[0]; ?>~<?= $cp[1]; ?>&lvl=15&typ=d&sty=r&src=SHELL&FORM=MBEDV8" scrolling="no">
       </iframe>
  </div>
</body>
</html>
