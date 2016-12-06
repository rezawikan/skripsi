<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Product\Product;
use Emall\Shipment\Shipment;
use Emall\Transaction\Order;
use Emall\Database\Database;

$load              = new Product;
$shipment          = new Shipment;
$order             = new Order;
$database          = Database::getInstance();
$buyerID           = $_COOKIE['id-buyer'];
$cookie            = urldecode($_COOKIE['cart']);
$dataCookieExplode = explode(',', $cookie);
$listID []         = $_POST['sellerID'];
$id                = $_POST['sellerID'];
$courier           = $_POST['courier'];
$costid            = $_POST['costid'];

$dataOrderWithQty = array_count_values($dataCookieExplode);
// echo json_encode($dataOrderWithQty);

foreach ($dataOrderWithQty as $key => $value) {
    $i = 0;
    $LoadSellerID = $load->check($key);
    $sellerID     = $LoadSellerID->sellerID;
    $price        = (int)$LoadSellerID->productPrice;
    $weight       = $LoadSellerID->productWeight;
    $shortDesc    = $LoadSellerID->shortDescription;
    $name         = $LoadSellerID->productName;


    if(in_array($sellerID, $listID)){
      $data[$sellerID]['order'][] = ['productID' => $key, 'quantity' => $value, 'price' => $price, 'total' => $value*$price, 'shortDesc' => $shortDesc, 'productName' => $name];
      $temp[$sellerID]['temp_total'][]    = ($value*$price);
      $temp[$sellerID]['total_qty'][]     = $value;
      $temp[$sellerID]['total_weight'][]  = $weight;
      $data[$sellerID]['total_weight']    = array_sum($temp[$sellerID]['total_weight']);
      $data[$sellerID]['total_qty']       = array_sum($temp[$sellerID]['total_qty']);
      $data[$sellerID]['sub_total']       = array_sum($temp[$sellerID]['temp_total']);
    }

}

// echo json_encode($data);


$loadB      = $shipment->showBuyer($buyerID);
$loadS      = $shipment->showSeller($sellerID);

// var_dump($id);
$origin      = $loadB->districts;
$destination = $loadS->districts;
$weights     = $data[$id]['total_weight'];
$cost        = $shipment->showCost($origin,$destination,$weights,$courier);

$decoded = json_decode($cost , true);

$results  = $decoded['rajaongkir']['results'];
// $delivery = [];

  foreach( $results as $first => $shipment ){
    foreach( $shipment['costs'] as $second => $costs ){
      foreach( $costs['cost'] as $third => $cost ){
        if($second == $costid ){
          $costp = ((empty($cost['etd'])) ? 'Tidak Diketahui' : $cost['etd']);
          $data[$id]['shipment']['code'] =  $shipment['code'];
          $data[$id]['shipment']['description'] =  $costs['description'];
          $data[$id]['shipment']['cost'] = $cost['value'];
          $data[$id]['shipment']['estimation'] = $costp;
        }
      }
    }
  }

// echo json_encode($data);



$order->processOrder($buyerID);
$lastID      = $database->lastID();
$name        = $data[$id]['shipment']['description'];
$cost        = $data[$id]['shipment']['cost'];
$weight      = $data[$id]['total_weight'];
$estimation  = $data[$id]['shipment']['estimation'];
$orderID     = $lastID;
$order->setCourier($name, $cost, $weight, $estimation, $orderID);
//
//
foreach ($data[$id]['order'] as $key => $value) {
  $quantity  = $value['quantity'];
  $productID = $value['productID'];
  $order->processOrderDetails($lastID, $quantity, $productID);
  $dataOrder[] = $value['productID'];
}

$result  = array_diff($dataCookieExplode, $dataOrder);

foreach ($result as $key => $value) {
  $updateCookie[] = $value;
}

if (isset($updateCookie)){
    echo json_encode($updateCookie);
} else {
   echo "string";
}

?>
