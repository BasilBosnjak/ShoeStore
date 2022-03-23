<?php

class ProjectDao{

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
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    $stmt = $this->conn->prepare("DELETE FROM todos WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }

  /**
  * Update todo record
  */

  public function update($id, $description, $created){
    $stmt = $this->conn->prepare("UPDATE todos SET description=:description, created=:created WHERE id=:id");
    $stmt->execute(['id' => $id, 'description' => $description, 'created' => $created]);
  }

}

?>
