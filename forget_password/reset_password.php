<?php
include '../connect.php';

$email = filterRequest("email");
$password = sha1($_POST['password']);

$stmt = $con->prepare("UPDATE users SET users_password = '$password' WHERE users_email = ?");
$stmt->execute(array($email));

$count = $stmt->rowCount();
sendResult($count);
