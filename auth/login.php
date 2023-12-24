<?php
include "../connect.php";

$password  = sha1($_POST['password']);
$email = filterRequest("email");

//Check if there is account have email and password user entered in the frontend.
// $stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? AND users_password = ? AND users_approve = 1");
// $stmt->execute(array($email, $password));
// $count = $stmt->rowCount();
// sendResult($count);

getData("users", "users_email = ? AND users_password = ? AND users_approve = 1", array($email, $password));
