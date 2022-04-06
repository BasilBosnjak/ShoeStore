<?php

class UserDao{

  private $conn;

  /**
  * constructor of dao class
  */
  public function __construct(){
    $servername = "sql.freedb.tech";
    $username = "freedb_ase_base";
    $password = "S@HFr?SdgG!Cx8F";
    $schema = "freedb_ShoeStore";
    $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);

    echo 'test';
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  /**
  * Method used to read all todo objects from database**/

  public function get_all(){
    $stmt = $this->conn->prepare("SELECT * FROM user");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  public function get_by_id($id){
    $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return reset($result);
  }
  /**
  * Method used to add todo to the database
  */

  public function add($user){
    $stmt = $this->conn->prepare("INSERT INTO user (first_name, last_name) VALUES (:first_name, :last_name)");
    $stmt->execute(['first_name' => $user['first_name'], 'last_name' => $user['last_name']]);
  }

  /**
  * Delete todo record from the database
  */

  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM user WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }

  /**
  * Update todo record
  */

  public function update($id, $data){
    $stmt = $this->conn->prepare("UPDATE user SET first_name=:first_name, last_name=:last_name WHERE id=:id");
    $stmt->execute(['id' => $id, 'first_name' => $data['first_name'], 'last_name' => $data['last_name']]);
  }

}

?>
