<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\User\Profile;
use Emall\Auth\Redirect;

$seller = new Profile;
if (isset($_POST['buyerID'])) {
    $sellerID = $_POST['buyerID'];
    $seller->getDataProfile($sellerID);
} else {
    Redirect::to('index.php'); // for direct acces to this file
}
