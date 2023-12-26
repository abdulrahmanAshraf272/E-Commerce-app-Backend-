<?php
include "../connect.php";

$email = filterRequest("email");
$verifycode = rand(100000, 999999);

//sendEmail($email, "Verify Code Ecommerce", "Verify Code $verifycode");
$stmt = $con->prepare("UPDATE users SET users_verifycode = $verifycode WHERE users_email = ?");
$stmt->execute(array($email));

printSuccess();
