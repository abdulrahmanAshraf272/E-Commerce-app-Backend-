<?php
include "../connect.php";

$code = filterRequest("code");

// //Check if there is account have email and password user entered in the frontend.
$stmt = $con->prepare("SELECT * FROM coupon WHERE coupon_code = ?");
$stmt->execute(array($code));
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
$message = "";
if ($count > 0) {
    //echo json_encode(array("status" => "success", "data" => $data));
    $usedLimit =  $data['coupon_used_limit'];
    $usedCounter = $data['coupon_used_counter'];
    $discount = $data['coupon_discount'];
    $expireData = strtotime($data['coupon_expire_date']);
    $current_date = time();

    // Compare the dates
    if ($expireData < $current_date) {
        echo json_encode(array("message" => "expired"));
    } else if ($usedLimit != null && $usedCounter >= $usedLimit) {
        echo json_encode(array("message" => "expired"));
    } else {
        echo json_encode(array("message" => "valid", "discount" => $discount));
    }
} else {
    echo json_encode(array("message" => "not exist"));
}
