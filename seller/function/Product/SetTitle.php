<?php
// session_start();
require_once '../../vendor/autoload.php';

use Emall\Auth\Redirect;
use Emall\Product\Product;

$load = new Product;
$home_url = '../../index.php';
// print_r($_POST);
if (isset($_POST['subcategoriesID'])){
    $categoryID = $_POST['subcategoriesID'];
    $result = $load->LoadSubCategoriesDetails($categoryID);
} else {
  Redirect::to($home_url);
}
