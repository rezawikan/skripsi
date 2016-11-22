<?php

namespace Emall\Pagination;

use Emall\Database\Database;

class Pagination
{
  private $conn ;

  public function __construct()
  {
    $this->conn = Database::getInstance();
  }

  public function TotalRows($sellerID, $subcategories = '')
  {
    $user = $this->conn;
    $user->setTable('product');
    if(is_null($subcategories)){
        $result = $user->select()->where('sellerID','=',$sellerID)->all();
    } else {
        $result = $user->select()->where('sellerID','=',$sellerID)->where('subcategoriesID','=',$subcategories)->all();
    }
    return count($result);
  }

  public function TotalRowsSearch($sellerID, $subcategories = '', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->select()->where('sellerID','=',$sellerID)->where('productName','LIKE','%' . $search . '%')->all();
    return count($result);
  }

  //default
  public function resultRangeByDefault($page_position, $item_per_page, $sellerID, $orderByProductID = 'ASC')
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.sellerID','=',$sellerID)
    ->where('product_images.status','=','main')
    ->select('product.productID, product.productName, product.shortDescription ,product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productID', $orderByProductID)
    ->limit($page_position . ',' . $item_per_page)
    ->all();
    return $result;
  }

  //  with subcategories
  public function resultRangeBySubcategories($page_position, $item_per_page, $sellerID, $subcategories, $orderByProductID = 'ASC')
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.sellerID','=',$sellerID)
    ->where('product.subcategoriesID','=',$subcategories)
    ->where('product_images.status','=','main')
    ->select('product.productID, product.productName, product.shortDescription, product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productID', $orderByProductID)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  //default price
  public function resultRangeByDefaultPrice($page_position, $item_per_page, $sellerID, $orderByPrice = 'ASC')
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.sellerID','=',$sellerID)
    ->where('product_images.status','=','main')
    ->select('product.productID, product.productName, product.shortDescription ,product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productPrice', $orderByPrice)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  // default with price
  public function resultRangeBySubcategoriesAndPrice($page_position, $item_per_page, $sellerID, $subcategories, $orderByPrice = 'ASC')
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.sellerID','=',$sellerID)
    ->where('product.subcategoriesID','=',$subcategories)
    ->where('product_images.status','=','main')
    ->select('product.productID, product.productName, product.shortDescription, product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productPrice', $orderByPrice)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  //default search
  public function resultRangeByDefaultAndSearch($page_position, $item_per_page, $sellerID, $orderByProductID = 'ASC', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.sellerID','=',$sellerID)
    ->where('product_images.status','=','main')
    ->where('productName','LIKE','%' . $search . '%')
    ->select('product.productID, product.productName, product.shortDescription ,product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productID', $orderByProductID)
    ->limit($page_position . ',' . $item_per_page)
    ->all();
    return $result;
  }

  //  with subcategories
  public function resultRangeBySubcategoriesAndSearch($page_position, $item_per_page, $sellerID, $subcategories, $orderByProductID = 'ASC', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.sellerID','=',$sellerID)
    ->where('product.subcategoriesID','=',$subcategories)
    ->where('product_images.status','=','main')
    ->where('productName','LIKE','%' . $search . '%')
    ->select('product.productID, product.productName, product.shortDescription, product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productID', $orderByProductID)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  //default price
  public function resultRangeByDefaultPriceAndSearch($page_position, $item_per_page, $sellerID, $orderByPrice = 'ASC', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.sellerID','=',$sellerID)
    ->where('product_images.status','=','main')
    ->where('productName','LIKE','%' . $search . '%')
    ->select('product.productID, product.productName, product.shortDescription ,product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productPrice', $orderByPrice)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  // default with price
  public function resultRangeBySubcategoriesAndPriceAndSearch($page_position, $item_per_page, $sellerID, $subcategories, $orderByPrice = 'ASC', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.sellerID','=',$sellerID)
    ->where('product.subcategoriesID','=',$subcategories)
    ->where('product_images.status','=','main')
    ->where('productName','LIKE','%' . $search . '%')
    ->select('product.productID, product.productName, product.shortDescription, product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productPrice', $orderByPrice)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  function paginate_function($item_per_page, $current_page, $total_records, $total_pages, $first = '', $second = '', $third = '', $fourth = '', $subcategories = '', $psort = '', $dsort = '', $fifth = '' , $search = '' )
  {
      $pagination = '';
      if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
          $pagination .= '<ul class="pagination pull-right">';

          $right_links    = $current_page + 4;
          $previous       = $current_page - 3; //previous link
          $next           = $current_page + 1; //next link
          $first_link     = true; //boolean var to decide our first link

          if($current_page > 1) {
              $previous_link = ($previous==0) ? 1 : $previous;

              if ($previous_link > 0 && $current_page < 3){
                  $pagination .= '<li><a href="' . $first . $previous_link . $second . $subcategories . $third . $psort . $fourth . $dsort . $fifth . $search . '" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
              } elseif ($current_page == 4 ) {
                  $pagination .= '<li><a href="' . $first . $previous_link . $second . $subcategories . $third . $psort . $fourth . $dsort . $fifth . $search . '" title="Previous">&lt;</a></li>'; //previous link
              } elseif ($current_page > 4) {
                  $pagination .= '<li><a href="product.php?page=1' . $second . $subcategories . $third . $psort . $fourth . $dsort . $fifth . $search . '" data-page="1" title="First">&laquo;</a></li>'; //first link
                  $pagination .= '<li><a href="' . $first . $previous_link . $second . $subcategories . $third . $psort . $fourth . $dsort . $fifth . $search . '" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
              }

                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="product.php?page='.$i. $second . $subcategories . $third . $psort . $fourth . $dsort . $fifth . $search . '" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }
            $first_link = false; //set first link to false
          }

          if ($first_link) { //if current active page is first link
              $pagination .= '<li class="active"><a href="#">'. $current_page .' <span class="sr-only">(current)</span></a></li>';
          } elseif ($current_page == $total_pages) { //if it's the last active link
              $pagination .= '<li class="active"><a href="#">'. $current_page .' <span class="sr-only">(current)</span></a></li>';
          } else { //regular current link
              $pagination .= '<li class="active"><a href="#">'. $current_page .' <span class="sr-only">(current)</span></a></li>';
          }

          for ($i = $current_page+1; $i < $right_links ; $i++) { //create right-hand side links
              if ($i<=$total_pages) {
                  $pagination .= '<li><a href="' . $first . $i . $second . $subcategories . $third . $psort . $fourth . $dsort . $fifth . $search . '" data-page="'.$i.'" title="Page '. $i.'">'.$i.'</a></li>';
              }
          }

          if (($total_pages - $current_page) == 4) {
              $next_link = ($i > $total_pages) ? $total_pages : $i;
              $pagination .= '<li><a href="' . $first . $next_link . $second . $subcategories . $third . $psort . $fourth . $dsort . $fifth . $search . '" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link

          } elseif ($current_page < $total_pages && ($total_pages - $current_page) > 3){
              $next_link = ($i > $total_pages) ? $total_pages : $i;
              $pagination .= '<li><a href="' . $first . $next_link  . $second . $subcategories . $third . $psort . $fourth . $dsort . $fifth . $search . '" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
              $pagination .= '<li class="last"><a href="' . $first . $total_pages . $second . $subcategories . $third . $psort . $fourth . $dsort . $fifth . $search . '" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
          }
          $pagination .= '</ul>';
      }
      return $pagination; //return pagination links
  }

}
