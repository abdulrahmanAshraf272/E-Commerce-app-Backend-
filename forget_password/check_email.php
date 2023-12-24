<?php
include '../connect.php';

$email = filterRequest("email");

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ?");
$stmt->execute(array($email));

$count = $stmt->rowCount();
if ($count > 0) {
    //Generate random number of 5 digits ,save it in database and send it to the user and see if match or not.
    $verifycode = rand(100000, 999999);
    //sendEmail($email, "Verify Code" , "Verify Code: $verifycode");
    $stmt = $con->prepare("UPDATE users SET users_verifycode = $verifycode WHERE users_email = ?");
    $stmt->execute(array($email));
    printSuccess();
} else {
    printFailure('the email is not correct');
}
