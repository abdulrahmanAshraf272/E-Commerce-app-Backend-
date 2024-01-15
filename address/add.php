<?php
include "../connect.php";

$table = "address";
$usersid = filterRequest("usersid");
$city = filterRequest("city");
$name = filterRequest('name');
$street = filterRequest("street");
$building = filterRequest("building");
$floor = filterRequest("floor");
$lat = filterRequest("lat");
$long = filterRequest("long");

$stmt = $con->prepare("INSERT INTO $table (address_usersid, address_city, address_street, address_building, address_floor, address_lat,address_long, address_name) VALUES (?, ?,?,?,?,?,?,?)");
$stmt->execute(array($usersid, $city, $street, $building, $floor, $lat, $long, $name));
$count = $stmt->rowCount();
if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "failure"));
}
