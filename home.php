<?php
include 'connect.php';

$alldata = array();

$alldata['status'] = 'success';

$categories = getAllData('categories', null, null, false);

$alldata['categories'] = $categories;

//if i want the product that have discount.
//$items = getAllData("itemsview", "items_discount != 0", null, false);
$items = getAllData("items1view", null, null, false);

$alldata['items'] = $items;


echo json_encode($alldata);
