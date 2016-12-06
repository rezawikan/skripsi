<?php

namespace Emall\User;
use PDO;
use Emall\Database\Database;

class Profile
{

  private $conn;

  public function __construct()
  {
    $this->conn = Database::getInstance();
	}

  // show all data profile
  public function getDataProfile($buyerID)
  {
    try {
        $user = $this->conn;
        $user->setTable('buyer');
        $result = $user->select()->where('buyerID','=',$buyerID)->first();

        echo json_encode($result);
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  }

  // update new data profile
  public function updateProfile($id,$firstName,$lastName,$email,$address,$province,$city,$district,$postalCode,$telpNum)
  {
    try {
        $user = $this->conn;
        $user->setTable('buyer');
        $result = $user->where('buyerID','=',$id)->update([
          'firstName' => $firstName,
          'lastName'  => $lastName,
          'email'     => $email,
          'address'   => $address,
          'province'  => $province,
          'city'      => $city,
          'districts' => $district,
          'postalcode' => $postalCode,
          'telpNumber' => $telpNum
        ]);

        $result['valid'] = 'Data bank successfully saved';
        echo json_encode($result);
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  }

  // save images profile
  public function saveFileName($id,$filename)
  {
    try {
        $user = $this->conn;
        $user->setTable('buyer');
        $user->where('buyerID','=',$id)->update([
          'image' => $filename
        ]);

        return true;
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  }

}
 ?>
