<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Shipment\Shipment;

$load        = new Shipment;
$sellerID    = $_POST['checkout'];
$buyerID     = $_POST['buyerID'];

$loadB      = $load->showBuyer($buyerID);
$loadS      = $load->showSeller($sellerID);


$origin      = $loadB->districts;
$destination = $loadS->districts;;
$weight      = $_POST['weight'];
$courier     = $_POST['courier'];
$result      = $load->showCost($origin,$destination,$weight,$courier);

echo $result;
