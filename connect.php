<?php
//declare "Host" and "Database Name"
$dsn = "mysql:host=localhost;dbname=ecommerce";
//because i working in local host it will be root and it means that allow to reach to anythings, and root is the default and have no password
$user = "root";
$password = "";
//to support arabic langauge
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
);
$countRowInPage = 9;
try {
    $con = new PDO($dsn, $user, $password, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
    header("Access-Control-Allow-Methods: POST, OPTIONS , GET");

    include "functions.php";
    if (!isset($notAuth)) {
        //checkAuthenticate();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
