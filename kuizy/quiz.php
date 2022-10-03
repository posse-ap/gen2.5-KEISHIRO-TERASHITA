  <?php
  try {
    //クエリから問題番号を取得
    $id = (int)filter_input(INPUT_GET, "id");

    //データベースに接続
    $pdo = new PDO(
      "mysql:host=db;dbname=posse;charset=utf8mb4",
      "root",
      "password"
    );

    // タイトルを取得
    $stmt = $pdo->prepare("SELECT name FROM posse.big_questions WHERE id = :n");
    $stmt->execute(["n" => $id]);
    $title = $stmt->fetch();

    // 問題・選択肢の取得
    $stmt = $pdo->prepare(
    "SELECT question_id, image, name, valid FROM questions JOIN choices 
    ON questions.id = choices.question_id 
    WHERE big_question_id = :big_question_id"
    );
    $stmt->execute([":big_question_id" => $id]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($questions);
    $questions_length = count($questions) / 3;
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  ?>

  <!DOCTYPE html>
  <html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/style.css">
    <title>
      <?= $title["name"] ?>
    </title>
  </head>

  <body>
    <article>
      <?php
      // 一問ずつ作成
      for ($question_num = 0; $question_num < $questions_length; $question_num++) :
      ?>
        <section>
          <h2><?= $question_num + 1 ?>.この地名はなんて読む？</h2>
          <img src="./img/<?= $questions[$question_num * 3]["image"] ?>" alt="">
          <ul>
            <?php
            // ランダムな数列の生成
            $random = [0, 1, 2];
            for ($i = 2; $i > 0; $i--) :
              $r = rand(0, $i);
              $tmp = $random[$i];
              $random[$i] = $random[$r];
              $random[$r] = $tmp;
            endfor;

            // 選択肢を表示
            for ($l = 0; $l < 3; $l++) :
            ?>
              <li id="choice_<?= $question_num ?>_<?= $l ?>_<?= $questions[$random[$l] + $question_num * 3]["valid"] ?>">
                <?= $questions[$random[$l] + $question_num * 3]["name"] ?>
              </li>
            <?php endfor; ?>
          </ul>
        </section>
      <?php endfor; ?>
    </article>
  </body>
  </html>
