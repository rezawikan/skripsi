<?php
session_start();
require_once 'vendor/autoload.php';

use Emall\Auth\Redirect;
use Emall\Transaction\Order;

$manage   = new Order;
$home_url = '../../index.php';


    $manage->ViewManageOrder(3);
