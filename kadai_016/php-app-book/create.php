<?php
$dsn = 'mysql:dbname=php_book_app;host=localhost;charset=utf8mb4';
$user = 'root';
$password = '';

if (isset($_POST['submit'])) {
  try {
    $pdo = new PDO($dsn, $user, $password);

    // 動的に変わる値をプレースホルダに置き換えたINSERT文をあらかじめ用意する
    $sql_insert = '
        INSERT INTO books (book_code, book_name, price, stock_quantity, genre_code)
        VALUES (:book_code, :book_name, :price, :stock_quantity, :genre_code)
    ';
    $stmt_insert = $pdo->prepare($sql_insert);

    // bindValue()メソッドを使って実際の値をプレースホルダにバインドする（割り当てる）
    $stmt_insert->bindValue(':book_code', $_POST['book_code'], PDO::PARAM_INT);
    $stmt_insert->bindValue(':book_name', $_POST['book_name'], PDO::PARAM_STR);
    $stmt_insert->bindValue(':price', $_POST['price'], PDO::PARAM_INT);
    $stmt_insert->bindValue(':stock_quantity', $_POST['stock_quantity'], PDO::PARAM_INT);
    $stmt_insert->bindValue(':genre_code', $_POST['genre_code'], PDO::PARAM_INT);

    // SQL文を実行する
    $stmt_insert->execute();

    // 商品一覧ページにリダイレクトさせる
    $count = $stmt_insert->rowCount();
 
    $message = "商品を{$count}件登録しました。";

    // 商品一覧ページにリダイレクトさせる（同時にmessageパラメータも渡す）
    header("Location: read.php?message={$message}");
  } catch (PDOException $e) {
    exit($e->getMessage());
  }
}

if(isset($_GET['submit']))
  try{
    $pdo = new PDO($dsn, $user, $password);
    $sql = "SELECT genre_code FROM genres";
    $stmt = $pdo->query($sql);

    $genre_codes = $stmt->fetchAll(PDO::FETCH_COLUMN);
  } catch(PDOException $e) {
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
      <a href="read.php">書類管理アプリ</a>
    </nav>
  </header>

  <main>
    <article class="registration">
      <h1>書類更新</h1>
      <div class="back">
        <a href="read.php" class="btn">&lt; 戻る</a>
      </div>
      <form action="create.php" method="post" class="registration-form">
        <div>
          <label for="book_code">商品コード</label>
          <input type="number" name="book_code" min="0" max="100000000" required>

          <label for="book_name">商品名</label>
          <input type="text" name="book_name" maxlength="50" required>

          <label for="price">単価</label>
          <input type="number" name="price" min="0" max="100000000" required>

          <label for="stock_quantity">在庫数</label>
          <input type="number" name="stock_quantity" min="0" max="100000000" required>

          <label for="genre_code">仕入先コード</label>
          <select name="genre_code" required>
            <option disabled selected value>選択してください</option>
            <?php
            foreach ($genre_codes as $genre_code) {
              echo "<option value='{$genre_code}'>{$genre_code}</option>";
            }
            ?>
          </select>
        </div>
        <button type="submit" class="submit-btn" name="submit" value="create">登録</button>
      </form>
    </article>
  </main>

  <footer>
    <p class="copyright">
      &copy; 商品管理アプリ ALL rights reserved.
    </p>
  </footer>
</body>

</html>