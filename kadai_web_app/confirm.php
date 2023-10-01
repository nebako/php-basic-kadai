<!DOCTYPE html>
<html lang="ja">
 
<head>
  <meta charset="UTF-8">
  <title>PHP基礎課題</title>
</head>
 
<body>
  <h2>入力内容をご確認ください。</h2>
  <p>問題がなければ「確定」、修正する場合は「キャンセル」をクリックください。</p>
  <table border="1">
    <tr>
      <th>項目</th>
      <th>入力内容</th>
    </tr>
    <tr>
      <td>
        <label>社員名</label>
      </td>
      <td>
        <?php echo $_POST['employee_name']; ?>
      </td>
    </tr>
    <tr>
      <td>
        <label>年齢</label>
      </td>
      <td>
        <?php echo $_POST['employee_age']?>
      </td>
    </tr>
    <tr>
      <td>
        <label>所属部署</label>
      </td>
        <td>
        <?php echo $_POST['department'] ?>
        </td>
  </table>
  <p>
    <button id="confirm-btn" onclick="location.href='complete.php';">確定</button>
    <button id="cancel-btn" onclick="history.back();">キャンセル</button>
  </p>
</body>
 
</html>