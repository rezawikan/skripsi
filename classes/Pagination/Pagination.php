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

  // range default
  public function resultRangeByDefault($page_position, $item_per_page, $sellerID, $orderByProductID = 'DESC')
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

  //  range with subcategories
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

  //range default price price
  public function resultRangeByDefaultPrice($page_position, $item_per_page, $sellerID, $orderByPrice = 'DESC')
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

  // range default subcategories and price
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
  public function resultRangeByDefaultAndSearch($page_position, $item_per_page, $sellerID, $orderByProductID = 'DESC', $search)
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
  public function resultRangeBySubcategoriesAndSearch($page_position, $item_per_page, $sellerID, $subcategories, $orderByProductID = 'DESC', $search)
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
  public function resultRangeBySubcategoriesAndPriceAndSearch($page_position, $item_per_page, $sellerID, $subcategories, $orderByPrice = 'DESC', $search)
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

  // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  // Without SellerID
  // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

  public function TotalRowsWithoutSID($subcategories = '')
  {
    $user = $this->conn;
    $user->setTable('product');
    if(is_null($subcategories)){
        $result = $user->select()->all();
    } else {
        $result = $user->select()->where('subcategoriesID','=',$subcategories)->all();
    }
    return count($result);
  }

  public function TotalRowsSearchWithoutSID($subcategories = '', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->select()->where('productName','LIKE','%' . $search . '%')->all();
    return count($result);
  }

  //default
  public function resultRangeByDefaultWithoutSID($page_position, $item_per_page, $orderByProductID = 'ASC')
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product_images.status','=','main')
    ->select('product.productID, product.productName, product.shortDescription ,product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productID', $orderByProductID)
    ->limit($page_position . ',' . $item_per_page)
    ->all();
    return $result;
  }

  //  with subcategories
  public function resultRangeBySubcategoriesWithoutSID($page_position, $item_per_page, $subcategories, $orderByProductID = 'DESC')
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.subcategoriesID','=',$subcategories)
    ->where('product_images.status','=','main')
    ->select('product.productID, product.productName, product.shortDescription, product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productID', $orderByProductID)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  //default price
  public function resultRangeByDefaultPriceWithoutSID($page_position, $item_per_page, $orderByPrice = 'DESC')
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product_images.status','=','main')
    ->select('product.productID, product.productName, product.shortDescription ,product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productPrice', $orderByPrice)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  // default with price
  public function resultRangeBySubcategoriesAndPriceWithoutSID($page_position, $item_per_page, $subcategories, $orderByPrice = 'DESC')
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.subcategoriesID','=',$subcategories)
    ->where('product_images.status','=','main')
    ->select('product.productID, product.productName, product.shortDescription, product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productPrice', $orderByPrice)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  //default search
  public function resultRangeByDefaultAndSearchWithoutSID($page_position, $item_per_page, $orderByProductID = 'DESC', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product_images.status','=','main')
    ->where('productName','LIKE','%' . $search . '%')
    ->select('product.productID, product.productName, product.shortDescription ,product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productID', $orderByProductID)
    ->limit($page_position . ',' . $item_per_page)
    ->all();
    return $result;
  }

  //  with subcategories
  public function resultRangeBySubcategoriesAndSearchWithoutSID($page_position, $item_per_page, $subcategories, $orderByProductID = 'DESC', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
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
  public function resultRangeByDefaultPriceAndSearchWithoutSID($page_position, $item_per_page, $orderByPrice = 'DESC', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product_images.status','=','main')
    ->where('productName','LIKE','%' . $search . '%')
    ->select('product.productID, product.productName, product.shortDescription ,product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productPrice', $orderByPrice)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

  // default with price
  public function resultRangeBySubcategoriesAndPriceAndSearchhWithoutSID($page_position, $item_per_page, $subcategories, $orderByPrice = 'DESC', $search)
  {
    $user = $this->conn;
    $user->setTable('product');
    $result = $user->join('product_images','product.productID','=','product_images.product_id')
    ->where('product.subcategoriesID','=',$subcategories)
    ->where('product_images.status','=','main')
    ->where('productName','LIKE','%' . $search . '%')
    ->select('product.productID, product.productName, product.shortDescription, product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
    ->orderBy('productPrice', $orderByPrice)
    ->limit($page_position . ',' . $item_per_page )
    ->all();
    return $result;
  }

// ($item_per_page, $current_page, $total_records, $total_pages, $first = '', $second = '', $third = '', $fourth = '', $subcategories = '', $psort = '', $dsort = '', $fifth = '' , $search = '')


//  1. $current_page 0
//  2. $total_pages 1
//  3. $first  for page 2
//  4. $second  for sub 3
//  5. $third   for seller 4
//  6. $fourth for psort 5
//  7. $fifth   for  dsort 6
//  8. $sixth for search 7
//  9 .$page ='', 8
//  10. $subcategories = '', 9
//  11 .$sellerID ='', 10
//  12. $psort = '', 11
//  13. $dsort = '', 12
//  14. $search = '' 13

  function paginate_function(array $data)
  {

      $pagination = '';
      if ($data[1] > 0 && $data[1] != 1 && $data[0] <= $data[1]) { //verify total pages and current page number
          $pagination .= '<ul class="pagination pull-right">';

          $right_links    = $data[0] + 4;
          $previous       = $data[0] - 3; //previous link
          $next           = $data[0] + 1; //next link
          $first_link     = true; //boolean var to decide our first link

          if($data[0] > 1) {
              $previous_link = ($previous==0) ? 1 : $previous;

              if ($previous_link > 0 && $data[0] < 3){
                  $link = $data[2] . $previous_link . $data[3] . $data[9] . $data[4] . $data[10] . $data[5] . $data[11] . $data[6] . $data[12] . $data[7] . $data[13] ;
                  $pagination .= '<li><a href="' .  $link . '" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
              } elseif ($data[0] == 4 ) {
                  $pagination .= '<li><a href="'.$link.'" title="Previous">&lt;</a></li>'; //previous link
              } elseif ($data[0] > 4) {
                  $link   = $data[3] . $data[9] . $data[4] . $data[10] . $data[5] . $data[11] . $data[6] . $data[12] . $data[7] . $data[13] ;
                  $link2  = $data[2] . $previous_link . $data[3] . $data[9] . $data[4] . $data[10] . $data[5] . $data[11] . $data[6] . $data[12] . $data[7] . $data[13];
                  $pagination .= '<li><a href="product.php?page=1' . $link . '" data-page="1" title="First">&laquo;</a></li>'; //first link
                  $pagination .= '<li><a href="' . $link2 .'" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
              }


                for($i = ($data[0]-2); $i < $data[0]; $i++){ //Create left-hand side links
                    if($i > 0){
                        $link = $i. $data[3] . $data[9] . $data[4] . $data[10] . $data[5] . $data[11] . $data[6] . $data[12] . $data[7] . $data[13];
                        $pagination .= '<li><a href="product.php?page='.$link.'" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }
            $first_link = false; //set first link to false
          }

          if ($first_link) { //if current active page is first link
              $pagination .= '<li class="active"><a href="#">'. $data[0] .' <span class="sr-only">(current)</span></a></li>';
          } elseif ($data[0] == $data[1]) { //if it's the last active link
              $pagination .= '<li class="active"><a href="#">'. $data[0] .' <span class="sr-only">(current)</span></a></li>';
          } else { //regular current link
              $pagination .= '<li class="active"><a href="#">'. $data[0] .' <span class="sr-only">(current)</span></a></li>';
          }

          for ($i = $data[0]+1; $i < $right_links ; $i++) { //create right-hand side links
              if ($i<=$data[1]) {
                  $link = $data[2] . $i . $data[3] . $data[9] . $data[4] . $data[10] . $data[5] . $data[11] . $data[6] . $data[12] . $data[7] . $data[13];
                  $pagination .= '<li><a href="' . $link . '" data-page="'.$i.'" title="Page '. $i.'">'.$i.'</a></li>';
              }
          }

          if (($data[1] - $data[0]) == 4) {
              $next_link = ($i > $data[1]) ? $data[1] : $i;
              $link      =  $data[2] . $next_link . $data[3] . $data[9] . $data[4] . $data[10] . $data[5] . $data[11] . $data[6] . $data[12] . $data[7] . $data[13];
              $pagination .= '<li><a href="' .$link.'" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link

          } elseif ($data[0] < $data[1] && ($data[1] - $data[0]) > 3){
              $next_link = ($i > $data[1]) ? $data[1] : $i;
              $link      = $data[2] . $next_link  . $data[3] . $data[9] . $data[4] . $data[10] . $data[5] . $data[11] . $data[6] . $data[12] . $data[7] . $data[13];
              $link2     = $data[2] . $data[1] . $data[3] . $data[9] . $data[4] . $data[10] . $data[5] . $data[11] . $data[6] . $data[12] . $data[7] . $data[13];
              $pagination .= '<li><a href="' . $link2 .'" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
              $pagination .= '<li class="last"><a href="' .$link2.'" data-page="'.$data[1].'" title="Last">&raquo;</a></li>'; //last link
          }
          $pagination .= '</ul>';
      }
      return $pagination; //return pagination links
  }

}
