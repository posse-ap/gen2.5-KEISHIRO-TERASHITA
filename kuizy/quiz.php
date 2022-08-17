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

    // 問題の取得
    $stmt = $pdo->prepare("SELECT * FROM posse.questions WHERE big_question_id = :big_question_id");
    $stmt->execute([":big_question_id" => $id]);
    $questions = $stmt->fetchAll();
    $questions_length = count($questions);
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

        // 選択肢の取得
        $stmt = $pdo->prepare("SELECT * FROM posse.choices WHERE question_id = :question_num");
        $stmt->execute([":question_num" => $questions[$question_num]["id"]]);
        $choices = $stmt->fetchAll();
      ?>
        <section>
          <h2><?= $question_num + 1 ?>.この地名はなんて読む？</h2>
          <img src="./img/<?= $questions[$question_num]["image"] ?>" alt="">
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
              <li id="choice_<?= $question_num ?>_<?= $l ?>_<?= $choices[$random[$l]]["valid"] ?>">
                <?= $choices[$random[$l]]["name"] ?>
              </li>
            <?php endfor; ?>
          </ul>
        </section>
      <?php endfor; ?>
    </article>
  </body>
  </html>
