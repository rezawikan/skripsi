<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Pagination\Pagination;
use Emall\Auth\Session;
use Emall\Auth\Redirect;
use Emall\Auth\Filter;

$page     = new Pagination;
$home_url = '../../index.php';


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

  if (isset($_POST['seller_id'])) {
      if (!is_numeric($_POST['seller_id'])){
          $sellerID = null;
      } else {
          $sellerID = Filter::IntegerFilter($_POST['seller_id']);
      }
  } else {
      $sellerID = null;
  }

  if (isset($sellerID)) {
      $total_records = $page->TotalRows($sellerID, $subcategories);
  } else {
      $total_records = $page->TotalRowsWithoutSID($subcategories);

  }

  $total_pages        = ceil($total_records/$item_per_page);
  $page_position      = (($page_number-1) * $item_per_page);

  if (isset($sellerID, $subcategories, $priceSort)) {
      $results = $page->resultRangeBySubcategoriesAndPrice($page_position, $item_per_page, $sellerID, $subcategories, $priceSort);
  } elseif (isset($sellerID, $subcategories, $defaultSort)) {
      $results = $page->resultRangeBySubcategories($page_position, $item_per_page, $sellerID, $subcategories, $defaultSort);
  } elseif (isset($sellerID, $priceSort)) {
      $results = $page->resultRangeByDefaultPrice($page_position, $item_per_page, $sellerID, $priceSort);
  } elseif (isset($sellerID, $subcategories)) {
        $results = $page->resultRangeBySubcategories($page_position, $item_per_page, $sellerID, $subcategories);
  } elseif (isset($sellerID, $defaultSort)) {
      $results = $page->resultRangeByDefault($page_position, $item_per_page, $sellerID, $defaultSort);
  } elseif (isset($sellerID)) {
      $results = $page->resultRangeByDefault($page_position, $item_per_page, $sellerID);
  } elseif (isset($priceSort, $subcategories)) {
      $results = $page->resultRangeBySubcategoriesAndPriceWithoutSID($page_position, $item_per_page, $subcategories, $priceSort);
  } elseif (isset($priceSort)) {
      $results = $page->resultRangeByDefaultPriceWithoutSID($page_position, $item_per_page, $priceSort);
  } elseif (isset($subcategories, $defaultSort)) {
      $results = $page->resultRangeBySubcategoriesWithoutSID($page_position, $item_per_page, $subcategories, $defaultSort);
  } elseif (isset($subcategories)) {
      $results = $page->resultRangeBySubcategoriesWithoutSID($page_position, $item_per_page, $subcategories);
  } elseif (isset($defaultSort)){
      $results = $page->resultRangeByDefaultWithoutSID($page_position, $item_per_page, $defaultSort);
  } else {
      $results = $page->resultRangeByDefaultWithoutSID($page_position, $item_per_page);
  }

  echo json_encode($results);
} else {
    Redirect::to($home_url); // for direct acces to this file
}
