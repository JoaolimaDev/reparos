<?php
class Database {
    // DB Params
   
    private $host = 'smartsolutionsbrasil.com.br';
    private $username = 'smart_gip';
    //private $db_name = 'smart_gip_pecabostoagostinho';
    private $password = '@eip#2021j';
    private $conn;
  
  
    // DB Connect
  
  
    public function connect(string $db_name) {
      $this->conn = null;
  
      try {
        
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $db_name,
        $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
  
      $this->conn->exec("SET CHARACTER SET utf8");
      
      return $this->conn;
    }
  

}
?>