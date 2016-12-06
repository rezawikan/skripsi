<?php

namespace Emall\Transaction;

use PDO;
use DateTime;
use Emall\Database\Database;
use Emall\Auth\Redirect;
use Emall\Auth\Session;

class Order
{

  private $conn;

  public function __construct()
  {
    $this->conn = Database::getInstance();
  }

  public function processOrder($buyerID)
  {
    try {
        $user = $this->conn;
        $user->setTable('orders');
        $user->create([
          'buyerID'   => $buyerID,
          'create_at' => date_format(new DateTime(), 'Y-m-d H:i:s')
        ]);

        return true;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
    }
  }

  public function setCourier($name, $cost, $weight, $estimation, $orderID)
  {
    try {
        $user = $this->conn;
        $user->setTable('delivery');
        $user->create([
          'name'        => $name,
          'cost'        => $cost,
          'weight'      => $weight,
          'estimation'  => $estimation,
          'orderID'     => $orderID,
          'create_at' => date_format(new DateTime(), 'Y-m-d H:i:s')
        ]);

        return true;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
    }
  }

  public function processOrderDetails($lastID, $quantity, $productID)
  {
    try {
        $user = $this->conn;
        $user->setTable('order_details');
        $user->create([
          'orderID'     => $lastID,
          'quantity'    => $quantity,
          'productID'   => $productID,
          'create_at' => date_format(new DateTime(), 'Y-m-d H:i:s')
        ]);

        return true;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
    }
  }

  public function ViewManageOrder($buyerID)
  {
    try {
        $user = $this->conn;
        $user->setTable('orders');
        $result = $user->join('delivery','orders.orderID','=','delivery.orderID')
        ->where('orders.buyerID','=',$buyerID)
        ->select('orders.orderID, delivery.status, delivery.cost, delivery.weight, delivery.estimation, delivery.update_at')
        ->orderBy('delivery.create_at', 'DESC')
        ->all();
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
    }
  }

  public function ViewOrderDetails($orderID)
  {
    try {
        $user = $this->conn;
        $user->setTable('orders');
        $result = $user->join('order_details','orders.orderID','=','order_details.orderID')
        ->join('product','order_details.productID','=','product.productID')
        ->where('orders.orderID','=',$orderID)
        ->select('orders.orderID, product.productName, product.productPrice, order_details.quantity')
        ->orderBy('order_details.create_at', 'ASC')
        ->all();
        return $result;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
    }
  }

  public function ViewCourierDetails($orderID)
  {
    try {
        $user = $this->conn;
        $user->setTable('delivery');
        $result = $user->select()
        ->where('orderID','=',$orderID)
        ->all();
        return $result;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
    }
  }

}

 ?>
