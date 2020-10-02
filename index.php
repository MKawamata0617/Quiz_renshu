<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Quiz.php');

$quiz = new MyApp\Quiz();

if (!$quiz->isFinished()) {
  $data = $quiz->getCurrentQuiz();
  shuffle($data['a']);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Quiz</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php if ($quiz->isFinished()) : ?>
    <div id="container">
      <div id="result">
        あなたの結果は ...
        <div>100 %</div>
      </div>
      <a href=""><div id="btn">もう１回</div></a>
    </div>
    <?php $quiz->reset(); ?>
  <?php else : ?>
    <div id="container">
      <h1>Q. <?= h($data['q']); ?></h1>
      <ul>
        <?php foreach ($data['a'] as $a) : ?>
          <li class="answer"><?= h($a); ?></li>
        <?php endforeach; ?>
      </ul>
      <div id="btn" class="disabled"><?= $quiz->isLast() ? '結果を見る' : '次の問題'; ?></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="quiz.js"></script>
  <?php endif; ?>
</body>
</html>