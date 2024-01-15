<?php
include '../connect.php';

$couponId = filterRequest('couponId');

deleteData("coupon", "coupon_id = $couponId");
