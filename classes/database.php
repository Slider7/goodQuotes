<?php 

class Database{
  private $db_host = 'sql107.epizy.com';
  private $db_user = 'epiz_28817371';
  private $db_pass = 'Uw9jgWs9Azrbw';
  private $db_name = 'epiz_28817371_goodquotes';

  protected $dbh;
  protected $stmt;

  public function __construct(){
    try {
      $this->dbh = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8', $this->db_user, $this->db_pass);
    } catch (PDOException $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
    
  }

  public function query($qry){
    try {
      $this->stmt = $this->dbh->prepare($qry);
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
    
  }

  public function bind($param, $value, $type = null){
    if(is_null($type)){
      switch (true) {
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute(){
    try {
      $this->stmt->execute();
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
    
  }

  public function resultSet():array {
    try {
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
  }

  public function lastInsertId(){
    return $this->dbh->lastInsertId();
  }

  public function single(){
    try {
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
  }
}


?>