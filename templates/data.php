<?php
session_start();
require_once 'vendor/autoload.php';

use Emall\Auth\Authentication;
use Emall\Database\Database;
use Emall\Auth\Redirect;


// initialize classes
$buyer     = Database::getInstance();
$log        = new Authentication;

$id = $_SESSION['buyerSession'];

if (!$log->is_logged_in()) {
    Redirect::to('index.php');
}

// get data users
$buyer->setTable('buyer');
$user = $buyer->select()->where('buyerID','=',$id)->first();
$user->fullName = $user->firstName . ' ' .$user->lastName;
