<?php include './config.php'; ?>
<?php include './classes/database.php'; ?>
<?php include './classes/quote.php'; ?>
<?php 
  if(isset($_POST['submit'])){
    $text = $_POST['text'] ?: null;
    $creator = $_POST['creator'] ?: 'Неизвестен';
    
    try {
      $quoteObj = new Quote();
      $quotes = $quoteObj->add($text, $creator);
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
  <title>GoodQuotes | Новая цитата</title>
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

      <div class="row marketing">
        <div class="col-lg-12">
          <h2 class='page-header'>Добавление цитаты</h2>
          <form method='POST' action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <label for='text'>Текст цитаты</label>
              <input type='text' name='text' class='form-control' placeholder='Введите текст' required>
            </div>
            <div class="form-group">
              <label for='creator'>Автор цитаты</label>
              <input type='text' name='creator' class='form-control' placeholder='Введите автора'>
            </div>
            <button type='submit' name='submit' class='btn btn-info'>Добавить</button>
          </form>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; 2020 GoodQuotes Inc.</p>
      </footer>

    </div> <!-- /container -->
  
</body>
</html>