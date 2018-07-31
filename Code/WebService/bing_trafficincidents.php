<?php
//header("Content-Type:application/json");
//header("Content-Type:text/xml");

function getcp()
{
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

  return $cp;
}


$cp = getcp();

print_r($cp);
$api_key = "AjDvdPcUrSfJfrA73THbzgQimIgKmNp1u4Q1GAq1TQKcEEVsGU_zn0BaJllRMkhm";
$longitud1 = floatval($cp[0]) -1;
$longitud2 = floatval($cp[0]) +1;
$latitude1 = floatval($cp[1]) +1;
$latitude2 = floatval($cp[1]) -1;

$mapArea = $longitud1 . "," .  $latitude1 . "," . $longitud2 . ",". $latitude2;//37,-105,45,-94";//"45.42449569,-73.97472251,45.40482142,73.91386055";
print_r($mapArea);

$url = "http://dev.virtualearth.net/REST/V1/Traffic/Incidents/"
  . $mapArea . "/"
  . "true?" . "t=9,2&s=2,3&"
  . "key=" . $api_key;

//print_r($url);
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$results = curl_exec($ch);
curl_close($ch);

$data = json_decode($results);
$rs = $data->resourceSets[0]->resources;
print_r($rs);
foreach($rs as $item){
  print_r($item->point->coordinates[0]);
  echo ', ';
  print_r($item->point->coordinates[1]);
  echo ', ';
  print_r($item->description);
  echo ', ';
  print_r($item->type);
  echo '<br />';
}
?>

<!--<html>
    <head>
        <title>Hello Bing</title>
    </head>
    <body onload='loadMapScenario();'>
      <div>
           <iframe width="500" height="400" frameborder="0"
           src="https://www.bing.com/maps/embed?h=400&w=500&cp=<?= $cp[0]?>~<?= $cp[1] ?>&lvl=11&typ=d&sty=r&src=SHELL&FORM=MBEDV8&pushpins=<?= $cp[0]?>~<?= $cp[1] ?>" scrolling="no"/>

      </div>

    </body>
</html>-->
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <script type='text/javascript'
            src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap'
            async defer></script>
    <script type='text/javascript'>
    function GetMap() {
        var map = new Microsoft.Maps.Map('#myMap', {
            credentials: '<?= $api_key ?>',
            center: new Microsoft.Maps.Location(<?= $cp[0]?>,<?= $cp[1] ?>)
        });
        <?php
        foreach($rs as $item): ?>
          var center = new Microsoft.Maps.Location(<?= $item->point->coordinates[0] ?>,<?= $item->point->coordinates[1] ?>);//new Microsoft.Maps.Location(<?= $item->point->coordinates[0] ?>, <?= $item->point->coordinates[1] ?>);
          var pin = new Microsoft.Maps.Pushpin(center, {
              title: '<?= $item->description?>',
              subTitle: '<?= $item->type?>',
              text: '-'
          });

          //Add the pushpin to the map
          map.entities.push(pin);
        <?php endforeach; ?>
    }
    </script>
</head>
<body>
    <div id="myMap" style="position:relative;width:600px;height:400px;"></div>
</body>
</html>
