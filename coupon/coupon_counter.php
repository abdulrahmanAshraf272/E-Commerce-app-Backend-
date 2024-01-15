<?php
include "../connect.php";

$code = filterRequest("code");

$stmt = $con->prepare("SELECT * FROM coupon WHERE coupon_code = ?");
$stmt->execute(array($code));
$data = $stmt->fetch(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();
if ($count > 0) {
    //echo json_encode(array("status" => "success", "data" => $data));
    $usedLimit = $data['coupon_used_limit'];
    $usedCounter = $data['coupon_used_counter'];

    if ($usedLimit != null) {
        $usedCounter = $usedCounter + 1;
        $stmt = $con->prepare("UPDATE coupon SET coupon_used_counter = $usedCounter WHERE coupon_code = '$code'");
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } else {
        echo json_encode(array("status" => "success"));
    }
} else {
    echo json_encode(array("message" => "failure"));
}
