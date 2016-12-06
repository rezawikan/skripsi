<?php
require_once '../../vendor/autoload.php';

use Emall\Product\Product;

$load              = new Product;
$cookie            = urldecode($_COOKIE['cart']);
$dataCookieExplode = explode(',', $cookie);

$listID = [];
foreach ($dataCookieExplode as $key => $value) {
  $results = $load->check($value);
  $id = $results->sellerID;
  if(!in_array($id , $listID)) // avoid duplicate sellerID
    $listID[] = $id ;
}

// echo json_encode($listID);
$dataOrderWithQty = array_count_values($dataCookieExplode);
// echo json_encode($dataOrderWithQty);

foreach ($dataOrderWithQty as $key => $value) {
    $i = 0;
    $loadData = $load->check($key);
    $sellerID     = $loadData->sellerID;
    $price        = (int)$loadData->productPrice;
    $shortDesc    = $loadData->shortDescription;
    $name         = $loadData->productName;

    if(in_array($sellerID, $listID)){
      $data[$sellerID]['order'][] = ['productID' => $key, 'quantity' => $value, 'price' => $price, 'total' => $value*$price, 'shortDesc' => $shortDesc, 'productName' => $name];
      $temp[$sellerID]['temp_total'][] = ($value*$price);
      $temp[$sellerID]['total_qty'][]  = $value;
      $data[$sellerID]['total_qty']    = array_sum($temp[$sellerID]['total_qty']);
      $data[$sellerID]['sub_total']    = array_sum($temp[$sellerID]['temp_total']);
    }
}


echo json_encode($data);
