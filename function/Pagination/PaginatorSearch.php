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
  } else {
    $defaultSort = null;
  }

  if (isset($_POST['search'])) {
      if (is_string($_POST['search'])){
          $search = Filter::StringFilter($_POST['search']);
      } else {
          $search = null;
      }
  }


  $total_records = $page->TotalRowsWithoutSID($subcategories);
  $total_pages        = ceil($total_records/$item_per_page);
  $page_position      = (($page_number-1) * $item_per_page);


  if (isset($priceSort, $subcategories,$search )) {
      $results = $page->resultRangeBySubcategoriesAndPriceAndSearchhWithoutSID($page_position, $item_per_page, $subcategories, $priceSort, $search);
  } elseif (isset($priceSort, $search)) {
      $results = $page->resultRangeByDefaultPriceAndSearchWithoutSID($page_position, $item_per_page, $priceSort, $search);
  } elseif (isset($subcategories, $defaultSort, $search)) {
      $results = $page->resultRangeBySubcategoriesAndSearchWithoutSID($page_position, $item_per_page, $subcategories, $defaultSort,$search);
  } elseif (isset($subcategories, $search)) {
      $results = $page->resultRangeBySubcategoriesAndSearchWithoutSID($page_position, $item_per_page, $subcategories, $search);
  } elseif (isset($defaultSort, $search)){
      $results = $page->resultRangeByDefaultAndSearchWithoutSID($page_position, $item_per_page, $defaultSort, $search);
  } else {
      $results = $page->resultRangeByDefaultAndSearchWithoutSID($page_position, $item_per_page, $defaultSort, $search);
  }

  echo json_encode($results);
} else {
    Redirect::to($home_url); // for direct acces to this file
}
