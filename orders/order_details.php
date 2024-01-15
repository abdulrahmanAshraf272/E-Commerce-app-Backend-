<?php
include '../connect.php';


$cartOrder = filterRequest('cartOrder');

$stmt = $con->prepare("SELECT * FROM cart WHERE cart_orders = ?");
$stmt->execute(array($cartOrder));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}
