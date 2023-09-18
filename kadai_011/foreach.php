<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>課題11</title>
  </head>
  <body>
    <p>
      <?php
      $vagetable_datas = ['名前' => '玉ねぎ', '値段' => 200, '産地' => '北海道'];
      foreach ($vagetable_datas as $key => $value) {
        echo "{$key}：{$value}<br>";
      }
      ?>
    </p>
  </body>
</html>