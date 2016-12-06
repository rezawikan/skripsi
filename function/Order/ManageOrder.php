<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Auth\Redirect;
use Emall\Transaction\Order;

$manage   = new Order;
$home_url = '../../index.php';

if (isset($_POST['buyerID'])) {
    $buyerID = ($_POST['buyerID']);
    $manage->ViewManageOrder($buyerID);
}else {
  Redirect::to($home_url); // for direct acces to this file
}
