<?php
session_start();
require_once './includes/library.php';
$pdo = connectdb();
$name = $_POST['name'] ?? "";
$rounds = $_POST['rounds'] ?? 0;
$errors = array();

if (isset($_POST['submit'])) {

  // if name is empty
  if ($name == "") {
    $errors['name'] = true;
  }
  // if no of rounds is not selected
  if ($rounds == 0) {
    $errors['rounds'] = true;
  }

  // if no errors
  if (empty($errors)) {
    // initializing a session
    $_SESSION['name'] = $name;
    $_SESSION['rounds'] = $rounds;
    $_SESSION['score'] = 0;
    $_SESSION['current'] = 1;
    $_SESSION['used_ids'] = [];
    $_SESSION['guesses'] = [];

    // fetching words from the database
    $query = "select id, word, difficulty from 3430_a1q2_words";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $words = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['words'] = $words;
    header("Location: play.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 1</title>
  <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
  <section>
    <h2>Welcome to the scramble game</h2>
    <form method="post">
      <div>
        <label for="name">Enter your name:</label>
        <input type="text" name="name" id="name" value="<?= $name ?>" />
        <span class="error <?= isset($errors['name']) ? '' : 'hidden' ?>">
          You must enter your name.
        </span>
      </div>
      <p>Select the number of rounds you would like to play:</p>
      <span class="error <?= isset($errors['rounds']) ? '' : 'hidden' ?>">
        You must select the number of rounds you would like to play.
      </span>
      <div>
        <input type="radio" name="rounds" id="rounds3" value="3" <?= (isset($rounds) && $rounds == "3") ? "checked" : ""; ?> />
        <label for="rounds">3</label>
      </div>
      <div>
        <input type="radio" name="rounds" id="rounds5" value="5" <?= (isset($rounds) && $rounds == "5") ? "checked" : ""; ?> />
        <label for="rounds">5</label>
      </div>
      <div>
        <input type="radio" name="rounds" id="rounds10" value="10" <?= (isset($rounds) && $rounds == "10") ? "checked" : ""; ?> />
        <label for="rounds">10</label>
        <div>
          <button type="submit" name="submit">Play</button>
        </div>
    </form>
  </section>
</body>

</html>