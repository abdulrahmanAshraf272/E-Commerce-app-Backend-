<?php
include '../connect.php';

$addressId = filterRequest('address_id');

deleteData("address", "address_id = $addressId");
