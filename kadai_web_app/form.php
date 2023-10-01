<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>PHP基礎課題</title>
  </head>
  <body>
    <form action="confirm.php"  method="post">
      <h2>社員情報入力フォーム</h2>
      <table>
        <tr>
          <td>
            <label>社員名</label>
          </td>
          <td>
            <input type="text" name="employee_name">
          </td>
        </tr>
        <tr>
          <td>
            <label>年齢</label>
          </td>
          <td>
          <input type="text" name="employee_age">
          </td>
        </tr>
        <tr>
          <td>
            <label>所属部署</label>
          </td>
          <td>
            <select name="department">
              <option>開発部</option>
              <option>営業部</option>
              <option>所属部所</option>
            </select>
          </td>
        </tr>
      </table>
      <input type="submit" value="送信">
    </form>
  </body>
</html>