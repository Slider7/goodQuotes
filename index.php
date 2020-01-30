<?php include './config.php'; ?>
<?php include './classes/database.php'; ?>
<?php include './classes/quote.php'; ?>
<?php 
  $quoteObj = new Quotes();
  $quotes = $quoteObj->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GoodQuotes</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">Главная <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="new.php">Новая цитата</a>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">GoodQuotes</h3>
      </div>

      <div class="jumbotron">
        <h1 class="display-3">Нашли цитату?</h1>
        <p class="lead">Сохраняйте здесь Ваши любимые цитаты и читайте их ежедневно, улучшайтесь.</p>
        <p><a class="btn btn-lg btn-success" href="new.php" role="button">Добавьте цитату сейчас</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <?php foreach($quotes as $q) : ?>
          <h3><?php echo $q['text']; ?></h3>
          <p><?php echo $q['creator']; ?></p>
          <?php endforeach; ?>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; 2020 GoodQuotes Inc.</p>
      </footer>

    </div> <!-- /container -->
  
</body>
</html>