<?php

// count products in cart
if (isset($_COOKIE['cart'])) {
    $cookie = urldecode($_COOKIE['cart']);
    $result = explode(',', $cookie);
    $count  = count($result);
}

$results = isset($count) ? $count : 0 ;
echo $results;
