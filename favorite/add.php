<?php
include '../connect.php';

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");

$stmt = $con->prepare("INSERT INTO `favorite` (`favorite_usersid`, `favorite_itemsid`) VALUES (?, ?)");
$stmt->execute(array($userid, $itemid));
$count = $stmt->rowCount();
if ($count > 0) {
    printSuccess();
} else {
    printFailure();
}
