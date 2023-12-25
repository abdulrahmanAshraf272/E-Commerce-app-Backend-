<?php
include '../connect.php';

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");

$stmt = $con->prepare("DELETE FROM `favorite` WHERE `favorite_usersid` = ? AND `favorite_itemsid` = ?");
$stmt->execute(array($userid, $itemid));
$count = $stmt->rowCount();
if ($count > 0) {
    printSuccess();
} else {
    printFailure();
}
