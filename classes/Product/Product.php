<?php

namespace Emall\Product;

use PDO;
use DateTime;
use Emall\Auth\Session;
use Emall\Database\Database;
use Emall\Files\ImagesProduct;

class Product
{
  private $conn;
  private $uploadProduct;

  public function __construct()
  {
      $this->conn   = Database::getInstance();
  }


  public function check($productID){
    try {
          $user = $this->conn;
          $user->setTable('product');
          $result = $user->select()->where('productID','=',$productID)->first();
          return $result;
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function LoadCategories()
  {
    try {
        $user = $this->conn;
        $user->setTable('categories');
        $result = $user->select()->all();
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function LoadSubCategories($categoryID)
  {
    try {
        $user = $this->conn;
        $user->setTable('sub_categories');
        $result = $user->select()->where('categoriesID','=',$categoryID)->all();
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function LoadSubCategoriesDetails($categoryID)
  {
    try {
        $user = $this->conn;
        $user->setTable('sub_categories');
        $result = $user->select()->where('subcategoriesID','=',$categoryID)->first();
        echo $result->subName;
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function LoadDataProducts($sellerID)
  {
    try {
        $user = $this->conn;
        $user->setTable('categories');
        $result = $user->join('sub_categories','categories.categoriesID','=','sub_categories.categoriesID')
        ->join('product','sub_categories.subcategoriesID','=','product.subcategoriesID')
        ->join('product_images','product.productID','=','product_images.product_id')
        ->where('product.sellerID','=',$sellerID)
        ->where('product_images.status','=','main')
        ->select('categories.categoryName, product.productID, product.productName, product_images.image_name, product.productPrice, product.productQty, product.productWeight')
        ->orderBy('productID','DESC')
        ->all();

        if ($result == null){
          $result['empty'] = 'Kosong';
        }
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function FindCategoriesID($subcategoriesID)
  {
    try {
        $user = $this->conn;
        $user->setTable('sub_categories');
        $result = $user->select()->where('subcategoriesID','=',$subcategoriesID)->first();
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function UpdateDataProduct($subcategories, $productName, $shortDescription, $description, $price, $weight, $quantity, $productID)
  {
    try {
        $update = $this->conn;
        $update->setTable('product');
        $result = $update->where('productID','=', $productID)
        ->update([
          'subcategoriesID'     => $subcategories,
          'productName'         => $productName,
          'shortDescription'    => $shortDescription,
          'productDescription'  => $description,
          'productPrice'        => $price,
          'productWeight'       => $weight,
          'productQty'          => $quantity
        ]);

        $status['valid'] = 'Data product successfully updated';
        echo json_encode($status);
		} catch (PDOException $e){
				echo "Error : ". $e->message();
		}
  }

  public function ViewDataProductDetails($productID)
  {
    try {
        $user = $this->conn;
        $user->setTable('product');
        $result = $user->select()->where('productID','=',$productID)->first();
        return $result;
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function ViewDataProductImage($productID)
  {
    try {
        $user = $this->conn;
        $user->setTable('product_images');
        $result = $user->select('image_name')->where('product_id','=',$productID)->all();
        return $result;
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

}
