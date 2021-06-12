<?php

class Quote extends Database{
  public function index(){
    try {
      $this->query('SELECT * FROM quotes ORDER BY create_date DESC');
      $i = 0;
      while ($rows = $this->resultSet()){
        if ($i < count($rows)) {
          yield $rows[$i];
          $i++;
        } else {
          return count($rows) . 'Quotes listed';
        }
      }
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
  }

  public function add(string $text, string $creator){
    try {
      $this->query('INSERT INTO quotes(text, creator) VALUES(:text, :creator)');
    /*      
      $this->stmt->bindValue(':text', $text, PDO::PARAM_STR);
      $this->stmt->bindValue(':creator', $creator, PDO::PARAM_STR); */
      $this->bind(':text', $text);
      $this->bind(':creator', $creator);
      $this->execute();
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
    //проверка
    if ($this->lastInsertId()) {
      //перенаправление
      header('Location: index.php');
    };
  }

  public function getSingle(int $id):array {
    try {
      $this->query('SELECT * FROM quotes WHERE id = :id');
      $this->bind(':id', $id);
      $row = $this->single();
      return $row;
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
  }

  public function update(int $id, string $text, string $creator)
  {
    try {
      $this->query('UPDATE quotes SET text = :text, creator = :creator WHERE id = :id');
      $this->bind(':id', $id);
      $this->bind(':text', $text);
      $this->bind(':creator', $creator);
      $this->execute();
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
    
    header('Location: index.php');
  }

  public function delete(int $id){
    try {
      $this->query('DELETE FROM quotes WHERE id = :id');
      $this->bind(':id', $id);
      $this->execute();
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
    header('Location: index.php');
  }

}
?>