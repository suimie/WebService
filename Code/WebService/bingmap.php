<?php
//header("Content-Type:application/json");
//header("Content-Type:text/xml");

$api_key = "AjDvdPcUrSfJfrA73THbzgQimIgKmNp1u4Q1GAq1TQKcEEVsGU_zn0BaJllRMkhm";
$country = "CA";
$province = "QC";
$city = "Montreal";
$address = urlencode("275 Notre-Dame East");
$postalCode = "H2Y1C6";

$url_structured = "http://dev.virtualearth.net/REST/v1/Locations/" . $country . "/"
//CA/adminDistrict/postalCode/locality/addressLine?includeNeighborhood=includeNeighborhood&include=includeValue&maxResults=maxResults&key=BingMapsKey";
  . $province . "/"
  . $postalCode . "/"
  . $city . "/"
  . $address . "?"
  . "key=" . $api_key;

//echo $url_structured;

/*
$url_unstructured = "http://dev.virtualearth.net/REST/v1/Locations?"
  . "countryRegion=" . $country . "&"
  . "adminDistrict=" . $province . "&"
  . "locality=" . $city . "&"
  . "postalCode=" . $postalCode . "&"
  . "addressLine=" . $address . "&"
  . "key=" . $api_key;
*/

//$url = urlencode($url_structured);
// json format
$ch = curl_init($url_structured);

// xml format
//$ch = curl_init($url_structured . "&o=xml");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$results = curl_exec($ch);
curl_close($ch);

$data = json_decode($results);
$cp = $data->resourceSets[0]->resources[0]->point->coordinates;

//print_r($results);
?>
<html>
    <head>
        <title>Hello Bing</title>
    </head>
    <body onload='loadMapScenario();'>
      <div>
           <iframe width="500" height="400" frameborder="0" src="https://www.bing.com/maps/embed?h=400&w=500&cp=<?= $cp[0]?>~<?= $cp[1] ?>&lvl=11&typ=d&sty=r&src=SHELL&FORM=MBEDV8" scrolling="no">
           </iframe>
      </div>

    </body>
</html>
