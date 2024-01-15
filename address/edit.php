<?php
include "../connect.php";

$table = "address";
$addressId = filterRequest("address_id");
$city = filterRequest("city");
$name = filterRequest('name');
$street = filterRequest("street");
$building = filterRequest("building");
$floor = filterRequest("floor");
$lat = filterRequest("lat");
$long = filterRequest("long");

$data = array(
    "address_name" => $name,
    "address_street" => $street,
    "address_building" => $building,
    "address_floor" => $floor,
    "address_lat" => $lat,
    "address_long" => $long,
    "address_city" => $city
);

updateData($table, $data, "address_id = $addressId");
