<?php
include '../connect.php';

$usersid = filterRequest('usersid');
$addressid = filterRequest('addressid');
$orderPrice = filterRequest('price');
$orderShipping = filterRequest('shipping');
$orderDiscount = filterRequest('discount');
$orderCouponDiscount = filterRequest('couponDiscount');
$orderPaymentMethod = filterRequest('paymentMethod');
$orderTotalPrice = filterRequest('totalPrice');


$sql = "INSERT INTO orders (orders_usersid, orders_addressid, orders_price, orders_shipping, orders_discount, orders_coupon_discount, orders_payment_method, orders_total_price) VALUES (?, ?,? ,? ,? ,? ,?, ?)";
$stmt = $con->prepare($sql);
$stmt->execute(array($usersid, $addressid, $orderPrice, $orderShipping, $orderDiscount, $orderCouponDiscount, $orderPaymentMethod, $orderTotalPrice));

$count = $stmt->rowCount();
if ($count > 0) {
    //Get the bigest number id in orders table (( the last one ))
    $stmt = $con->prepare("SELECT MAX(orders_id) FROM orders");
    $stmt->execute();
    $maxid = $stmt->fetchColumn();
    //$data = array("cart_orders" => $maxid);

    //the items in the cart that have cart_orders = 0 value - not checkout yet- change the value, change it to the last order
    $stmt = $con->prepare("UPDATE cart SET cart_orders = $maxid WHERE cart_usersid = $usersid AND cart_orders = 0");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    //updateData("cart", $data, "cart_usersid = $usersid AND cart_orders = 0");
} else {
    echo json_encode(array("status" => "failure"));
}
