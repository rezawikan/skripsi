<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Auth\Authentication as Auth;
use Emall\Auth\Redirect;

$buyer   = new Auth;
$result   = array();
$home_url = '../../index.php'; // redirect link

if (isset($_POST['dataID'],$_POST['code'])) {
    $id   = base64_decode($_POST['dataID']);
    $code = $_POST['code'];
    // check id and code $_GET, code is used
    if ($buyer->checkTemporaryCode($id, $code)) {
         $result['status'] = 'used';
    // check id and code $_GET
  } else if ($buyer->checkCode($id, $code)) {
        $result['status'] = 'none';
    } else {
       $result['status'] = 'notfound';
    }
} else {
    Redirect::to($home_url); // for direct acces to this file
}

echo json_encode($result);
