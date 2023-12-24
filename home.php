<?php
include 'connect.php';


$userid = filterRequest('userid');

$alldata = array();

//$categories = getAllData('categories', null, null, false);

// ======= Get Categories from database ========//
$stmt = $con->prepare("SELECT * FROM categories");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
$categoriesCount = $stmt->rowCount();

//if i want the product that have discount.
//$items = getAllData("itemsview", "items_discount != 0", null, false);

//$items = getAllData("items1view", null, null, false);

// =========== Get Items from database ==========//
$stmt = $con->prepare("SELECT items1view.*, 1 as favorite 
FROM items1view INNER JOIN favorite
ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid = $userid
UNION ALL
SELECT * , 0 as favorite
FROM items1view
WHERE items_id NOT IN 
(SELECT items1view.items_id
 FROM items1view INNER JOIN favorite 
 ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid = $userid)");
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
$itemsCount = $stmt->rowCount();

if ($categoriesCount > 0 && $itemsCount > 0) {
    $alldata['status'] = 'success';
    $alldata['categories'] = $categories;
    $alldata['items'] = $items;
} else {
    $alldata['status'] = 'failure';
}

echo json_encode($alldata);
