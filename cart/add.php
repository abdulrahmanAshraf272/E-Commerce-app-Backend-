<?php
include '../connect.php';

$usersid = filterRequest('usersid');
$itemsid = filterRequest('itemsid');
$numberOfProduct = filterRequest('numberOfProduct');

//$count = getData("cart", "cart_itemsid = $itemsid AND cart_usersid = $usersid");
for ($i = 0; $i < $numberOfProduct; $i++) {
    $sql = "INSERT INTO cart (cart_usersid , cart_itemsid) VALUES ($usersid, $itemsid)";
    $stmt = $con->prepare($sql);
    $stmt->execute();
}


$count = $stmt->rowCount();
if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "failure"));
}

// $data = array(
//     "cart_usersid" => $usersid,
//     "cart_itemsid" => $itemsid
// );

// insertData("cart", $data);
