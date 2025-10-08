<?php
session_start();
require_once './includes/library.php';

$total = $_SESSION['rounds'];
$current = $_SESSION['current'];
$score = $_SESSION['score'];
$used_words = $_SESSION['used_ids'];
$words = $_SESSION['words'];
$guesses = $_SESSION['guesses'];

// redirecting to results page
if ($current > $total) {
    header("Location: results.php");
    exit();
}

// selecting a new word if not already set for this round
if (!isset($_SESSION['current_word'])) {
    $available_words = array_filter($words, function ($word) use ($used_words) {
        return !in_array($word['id'], $used_words);
    });
    $selected_word = $available_words[array_rand($available_words)];
    $_SESSION['current_word'] = $selected_word;
    $_SESSION['used_ids'][] = $selected_word['id'];
    $_SESSION['remaining_attempts'] = ['easy' => 1, 'medium' => 2, 'hard' => 3][$selected_word['difficulty']];
}

// scrambling the selected word
$current_word = $_SESSION['current_word'];
$remaining_attempts = $_SESSION['remaining_attempts'];
$scrambled_word = str_shuffle($current_word['word']);
$message = "";

// calculating the remaining attempts and the score
if (isset($_POST['submit'])) {
    $guess = $_POST['guess'];
    $correct_word = $current_word['word'];
    if ($guess === $correct_word) {
        $points = [
            'easy' => 1,
            'medium' => $_SESSION['remaining_attempts'] == 2 ? 2 : 1,
            'hard' => $_SESSION['remaining_attempts'] == 3 ? 3 : ($_SESSION['remaining_attempts'] == 2 ? 2 : 1)
        ][$current_word['difficulty']];

        $_SESSION['score'] += $points;
        $_SESSION['guesses'][] = [
            'round' => $current,
            'word' => $current_word['word'],
            'guess' => $guess,
            'correct' => true,
            'attempts' => [$guess]
        ];

        $_SESSION['current']++;
        unset($_SESSION['current_word']);
        header("Location: play.php");
        exit();
    } else {
        $_SESSION['remaining_attempts']--;
        if ($_SESSION['remaining_attempts'] <= 0) {
            $_SESSION['guesses'][] = [
                'round' => $_SESSION['current'],
                'word' => $current_word['word'],
                'guess' => $guess,
                'correct' => false,
                'attempts' => [$guess]
            ];
            $_SESSION['current']++;
            unset($_SESSION['current_word']);
            header("Location: play.php");
            exit();
        } else {
            $message = "Incorrect attempt. You have {$_SESSION['remaining_attempts']} attempts left.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Word Scramble Game - Play</title>
</head>

<body>
    <h1>Round <?= $current ?> of <?= $total; ?></h1>
    <p>Scrambled word: <?= $scrambled_word; ?></p>
    <?php if ($message !== "") echo "$message"; ?>
    <form method="post">
        <label for="guess">Your guess:</label>
        <input type="text" name="guess" id="guess" required>
        <div>
        <button type="submit" name="submit">Submit Guess</button>
        </div>
    </form>
</body>

</html>