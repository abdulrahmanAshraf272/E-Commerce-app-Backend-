<?php
include '../connect.php';

$verifycode = filterRequest("verifycode");
$email = filterRequest("email");

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? AND users_verifycode = ?");
$stmt->execute(array($email, $verifycode));

$count = $stmt->rowCount();
sendResult($count);
