<?php
// First, we need to take their postcode and get the lat/lng pair:
$postcode = $_POST['postcode'];

// Sanitize their postcode:
$search_code = urlencode($postcode);
$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . $search_code . '&sensor=false';
$json = json_decode(file_get_contents($url));

$lat = $json->results[0]->geometry->location->lat;
$lng = $json->results[0]->geometry->location->lng;

// Now build the lookup:
$address_url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $lng . '&sensor=false';
$address_json = json_decode(file_get_contents($address_url));
$address_data = $address_json->results[0]->address_components;

$street = str_replace('Dr', 'Drive', $address_data[1]->long_name);
$town = $address_data[2]->long_name;
$county = $address_data[3]->long_name;

$array = array('street' => $street, 'town' => $town, 'county' => $county);
echo json_encode($array);?>
