<?php
require_once '../../vendor/autoload.php';

use Emall\Product\Product;
use Emall\Shipment\Shipment;
use Emall\Database\Database;

$load              = new Product;
$shipment          = new Shipment;
$database          = new Database;
$cookie            = urldecode($_COOKIE['cart']);
$dataCookieExplode = explode(',', $cookie);
$listID []         = $_POST['checkout'];
$id                = $_POST['checkout'];


// //
// $database = Database::getInstance();
// $database->setTable('buyer');
// $result = $database->select()->where('buyerID','=',$buyerID)->first();



// $listID = [];
// foreach ($dataCookieExplode as $key => $value) {
//   $results = $load->check($value);
//   $id = $results->sellerID;
//   if(!in_array($id , $listID)) // avoid duplicate sellerID
//     $listID[] = $id ;
// }

// echo json_encode($listID);
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
      $data[$id]['quantity'][] = $value;
    }
    // echo "product ID : " . $key. "<br />";
    // echo "seller ID : " . $sellerID. "<br />";
    // echo "quantity : " . $value. "<br />";
    // echo "<br />";

}

echo json_encode($data);
?>
