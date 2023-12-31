<?php
include '../connect.php';

$usersid = filterRequest('usersid');

$data = getAllData("cartview", "cart_usersid = $usersid", null, false);

$stmt = $con->prepare("SELECT SUM(itemsprice) as totalprice , SUM(countitems) as totalcount FROM cartview
WHERE cartview.cart_usersid = $usersid
GROUP BY  cart_usersid");

$stmt->execute();

$dataCountPrice = $stmt->fetch(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();
if ($count > 0) {
    echo json_encode(array(
        "status" => "success",
        "data" => $data,
        "count&price" => $dataCountPrice
    ));
} else {
    echo json_encode(array(
        "status" => "failure",
    ));
}
