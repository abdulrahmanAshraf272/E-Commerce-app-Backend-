<?php
include '../connect.php';

$usersid = filterRequest('usersid');
$itemsid = filterRequest('itemsid');

// $stmt = $con->prepare("DELETE FROM cart WHERE cart_id = (SELECT cart_id FROM cart WHERE cart_usersid = $usersid AND cart_itemsid = $itemsid LIMIT 1)");
// $stmt->execute();
// $count = $stmt->rowCount();

// if ($count > 0) {
//     echo json_encode(array("status" => "success"));
// } else {
//     echo json_encode(array("status" => "failure"));
// }


deleteData("cart", "cart_id = (SELECT cart_id FROM cart WHERE cart_usersid = $usersid AND cart_itemsid = $itemsid LIMIT 1)");
