<?php
include "../connect.php";

$username = filterRequest("username");
$password  = sha1($_POST['password']);
$email = filterRequest("email");
$phone = filterRequest("phone");
//Generate random number of 5 digits ,save it in database and send it to the user and see if match or not.
$verifycode = rand(100000, 999999);

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? OR users_phone = ?");
$stmt->execute(array($email, $phone));
$count = $stmt->rowCount();
if ($count > 0) {
    printFailure(message: "this account already exist");
} else {
    $data = array(
        "users_name" => $username,
        "users_password" => $password,
        "users_email" => $email,
        "users_phone" => $phone,
        "users_verifycode" => $verifycode,
    );

    //sendEmail($email, "Verify Code Ecommerce", "Verify Code $verifycode");
    insertData("users", $data);
    //printSuccess();
}
