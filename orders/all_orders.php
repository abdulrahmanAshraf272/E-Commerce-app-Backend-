<?php
include '../connect.php';


$userid = filterRequest('userid');

$stmt = $con->prepare("SELECT * FROM orders WHERE orders_usersid = ?");
$stmt->execute(array($userid));
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $orders));
} else {
    echo json_encode(array("status" => "failure"));
}
