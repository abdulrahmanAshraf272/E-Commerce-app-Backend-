<?php
include "../connect.php";

$table = "coupon";
$code = filterRequest("code");
$counter = filterRequest("counter");
$limit = filterRequest('limit');
$discount = filterRequest('discount');
$expireDate = filterRequest("expireDate");



$stmt = $con->prepare("INSERT INTO $table (coupon_code, coupon_used_counter, coupon_used_limit, coupon_discount, coupon_expire_date) VALUES (?, ?,?,?,?)");
$stmt->execute(array($code, $counter, $limit, $discount, $expireDate));
$count = $stmt->rowCount();
if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "failure"));
}
