<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Auth\Redirect;
use Emall\Transaction\Order;

$manage   = new Order;
$home_url = '../../index.php';

if (isset($_POST['orderID'])) {
    $orderID = ($_POST['orderID']);
    $listProduct['details'] = $manage->ViewOrderDetails($orderID);
    $listProduct['shipment'] = $manage->ViewCourierDetails($orderID);
    // $result = array_merge_recursive($listProduct,$dataCourier);
    echo json_encode($listProduct);
}else {
  Redirect::to($home_url); // for direct acces to this file
}
