<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Auth\Authentication as Auth;
use Emall\Auth\Redirect;

$buyer   = new Auth;
$home_url = '../../../index.php'; // redirect link
$result = array();

if (isset($_POST['password'],$_POST['id'])){
  $password 	= $_POST['password'];
  $id 		    = $_POST['id'];

  if ($buyer->updatePassword($password, $id))	{
      $result['valid'] = 'success';
      echo json_encode($result);
  }
} else {
		Redirect::to($home_url); // for direct acces to this file
}
