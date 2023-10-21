<?php
$dsn = 'mysql:dbname=php_book_app;host=localhost;charset=utf8mb4';
$user = 'root';
$password = '';

try {
  if(isset($_GET['order'])){
    $order = $_GET['order'];
  } else{
    $order = NULL;
  }
  
  if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
  } else{
    $keyword = NULL;
  }
  
  $pdo = new PDO($dsn, $user, $password);
  if ($order === 'desc') {
    $sql_select = 'SELECT * FROM books WHERE book_name LIKE :keyword ORDER BY book_code DESC';
  } else {
    $sql_select = 'SELECT * FROM books WHERE book_name LIKE :keyword ORDER BY book_code ASC';
  }
  $stmt_select = $pdo->prepare($sql_select);

  $partical_match = "%{$keyword}%";

  $stmt_select->bindValue(':keyword', $partical_match, PDO::PARAM_STR);

  $stmt_select->execute();
  $books = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e){
  exit($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>書類管理アプリ</title>
  <link rel="stylesheet" href="css/style.css">

  <!-- googleフォント読み込み -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <nav>
      <a href="index.php">書類管理アプリ</a>
    </nav>
  </header>

  <main>
    <article>
      <div class="books">
        <div>
          <h2>書類一覧</h2>
          <?php
          if(isset($_GET['message'])){
            $message = $_GET['message'];
            echo "<p class= 'change-message'>$message</p>";
          }
          ?>
          <div class="ui">
            <div>
              <a href="read.php?order=desc&keyword=<?= $keyword ?>">
                <img src="images/desc.png" alt="desc" class="sort-img">
              </a>
              <a href="read.php?order=asc&keyword=<?= $keyword ?>">
                <img src="images/asc.png" alt="asc" class="sort-img">
              </a>
              <form action="read.php" method="get" class="search-form">
                <input type="hidden" name="order" value="<?= $order ?>">
                <input type="text" class="search-box" placeholder="商品名で検索" name="keyword" value="">
              </form>
            </div>
            <a href="create.php?submit=create" class="btn">書類登録</a>
          </div>
        </div>

        <table class = "books-table">
          <tr>
            <th>書類コード</th>
            <th>書類名</th>
            <th>書類一覧</th>
            <th>在庫数</th>
            <th>ジャンルコード</th>
            <th>編集</th>
            <th>削除</th>
          </tr>
          <?php
          foreach($books as $book){
            $table_row = "
              <tr>
                <td>{$book['book_code']}</td>
                <td>{$book['book_name']}</td>
                <td>{$book['price']}</td>
                <td>{$book['stock_quantity']}</td>
                <td>{$book['genre_code']}</td>
                <td><a href='update.php?id={$book['id']}'><img src='images/edit.png' alt='編集ボタン' class='edit-icon'></a></td>
                <td><a href='delete.php?id={$book['id']}'><img src='images/delete.png' alt='削除ボタン' class='delete-icon'></td>  
              </tr>";
            echo $table_row;
          }
          ?>
        </table>

      </div>
    </article>
  </main>

  <footer>
    <p class="copyright">
      &copy; 商品管理アプリ ALL rights reserved.
    </p>
  </footer>
</body>

</html>