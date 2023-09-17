<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>課題5</title>
  </head>
  <body>
    <p>
      <?php
      $score1 = 80;
      $score2 = 60;
      $score3 = 55;
      $score4 = 44;
      $score5 = 100;
      $score6 = 25;
      $score7 = 80;
      $score8 = 95;
      $score9 = 30;
      $score10 = 60;
      $sum_score = $score1 + $score2 + $score3 + $score4 + $score5 + $score6 + $score7 + $score8 + $score9 + $score10;
      $avg_score = $sum_score / 10;
      echo $avg_score;
      ?>
    </p>
  </body>
</html>