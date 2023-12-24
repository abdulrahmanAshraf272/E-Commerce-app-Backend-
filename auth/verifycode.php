<?php
include "../connect.php";

$email = filterRequest("email");
$verifycode = filterRequest("verifycode");


$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? AND users_verifycode = ?");
$stmt->execute(array($email, $verifycode));

$stmt->execute();

$count = $stmt->rowCount();

if ($count > 0) {
    $updateData = $con->prepare("UPDATE users SET users_approve = 1 WHERE users_email = ?");
    $updateData->execute(array($email));
    echo json_encode(array("status" => "success"));
    // $data = array("users_approve" => "1");
    // updateData("users", $data, "users_email = $email");
    // echo 'done';
} else {
    printFailure("verifycode not correct");
}
