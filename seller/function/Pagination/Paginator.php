<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Pagination\Pagination;
use Emall\Auth\Session;
use Emall\Auth\Redirect;
use Emall\Auth\Filter;

$page     = new Pagination;
$home_url = '../../index.php';
$sellerID = Session::get('sellerSession');

if ($_POST) {
  if (isset($_POST['page'])) {
      if (!is_numeric($_POST['page'])){
          $page_number = 1;
      } else {
          $page_number = Filter::IntegerFilter($_POST['page']);
      }
  } else {
      $page_number = 1;
  }

  if (isset($_POST['limit'])) {
      if (!is_numeric($_POST['limit'])){
          $item_per_page = 24;
      } else {
          $item_per_page = $_POST['limit'];
      }
  } else {
      $item_per_page = 24;
  }

  if (isset($_POST['subcategories'])) {
      if (!is_numeric($_POST['subcategories'])){
          $subcategories = null;
      } else {
          $subcategories = Filter::IntegerFilter($_POST['subcategories']);
      }
  } else {
      $subcategories = null;
  }

  if ($_POST['psort'] == 'ASC' || $_POST['psort'] == 'DESC') {
      $priceSort = Filter::StringFilter($_POST['psort']);
  }

  if ($_POST['dsort'] == 'ASC' || $_POST['dsort'] == 'DESC') {
      $defaultSort = Filter::StringFilter($_POST['dsort']);
  }

  if (isset($subcategories)) {
      $total_records = $page->TotalRows($sellerID, $subcategories);
  } else {
      $total_records = $page->TotalRows($sellerID);
  }

  $total_pages        = ceil($total_records/$item_per_page);
  $page_position      = (($page_number-1) * $item_per_page);


  if (isset($priceSort, $subcategories)) {
      $results = $page->resultRangeBySubcategoriesAndPrice($page_position, $item_per_page, $sellerID, $subcategories, $priceSort);
  } elseif (isset($priceSort)) {
      $results = $page->resultRangeByDefaultPrice($page_position, $item_per_page, $sellerID, $priceSort);
  } elseif (isset($subcategories, $defaultSort)) {
      $results = $page->resultRangeBySubcategories($page_position, $item_per_page, $sellerID, $subcategories, $defaultSort);
  } elseif (isset($subcategories)) {
      $results = $page->resultRangeBySubcategories($page_position, $item_per_page, $sellerID, $subcategories);
  } elseif (isset($defaultSort)){
      $results = $page->resultRangeByDefault($page_position, $item_per_page, $sellerID, $defaultSort);
  } else {
        $results = $page->resultRangeByDefault($page_position, $item_per_page, $sellerID);
  }

  echo json_encode($results);
} else {
    Redirect::to($home_url); // for direct acces to this file
}
