<?php include './config.php'; ?>
<?php include './classes/database.php'; ?>
<?php include './classes/quote.php'; ?>
<?php 
  try {
    $quoteObj = new Quote();
    $quote = $quoteObj->getSingle($_GET['id']);
  } catch (Throwable $e) {
    echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
    ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
  }

  if(isset($_POST['submit'])){
    $id = $_GET['id'];
    $text = $_POST['text'] ?: null;
    $creator = $_POST['creator'] ?: 'Неизвестен';
    
    try {
      $quoteObj = new Quote();
      $quoteObj->update($id, $text, $creator);
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
  }

  if(isset($_POST['delete'])){
    $id = $_GET['id'];
    try {
      $quoteObj = new Quote();
      $quoteObj->delete($id);
    } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' в строке '.$e->getLine() .
      ' в файле '. $e->getFile() .': '.$e->getMessage().'</div>';
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GoodQuotes | Изменить цитату</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="new.php">Новая цитата</a>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">GoodQuotes</h3>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <h2 class='page-header'>Редактирование цитаты
            <form class='pull-right' method='POST' action="edit.php?id=<?php echo $_GET['id']; ?>">
              <button type='submit' name='delete' class='btn btn-danger'>Удалить</button>
            </form>
          </h2>
          <form method='POST' action="edit.php?id=<?php echo $_GET['id']; ?>">
            <div class="form-group">
              <label for='text'>Текст цитаты</label>
              <input type='text' name='text' class='form-control' placeholder='Введите текст' required value ="<?php echo $quote['text']; ?>" >
            </div>
            <div class="form-group">
              <label for='creator'>Автор цитаты</label>
              <input type='text' name='creator' class='form-control' placeholder='Введите автора' value ="<?php echo $quote['creator']; ?>">
            </div>
            <button type='submit' name='submit' class='btn btn-info'>Сохранить</button>
          </form>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; 2021 GoodQuotes Inc.</p>
      </footer>

    </div> <!-- container -->
  
</body>
</html>