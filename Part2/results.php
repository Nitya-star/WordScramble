<?php
session_start();
require_once './includes/library.php';
$pdo = connectdb();

if (!isset($_SESSION['name'])) {
    header("Location: start.php");
    exit();
}

$name = $_SESSION['name'];
$score = $_SESSION['score'];
$total = $_SESSION['rounds'];
$guesses = $_SESSION['guesses'];

// Calculate maximum possible score
$max_score = 0;
foreach ($guesses as $guess) {
    $difficulty = '';
    foreach ($_SESSION['words'] as $word) {
        if ($word['word'] === $guess['word']) {
            $difficulty = $word['difficulty'];
            break;
        }
    }
    $max_score += [
        'easy' => 1,
        'medium' => 2,
        'hard' => 3
    ][$difficulty];
}

$score_percent = round(($score / $max_score) * 100, 2);

// Insert into database
$query = "insert into 3430_a1q2_scores (name, score, play_percent) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($query)->execute([$name, $score, $score_percent]);

// Clear session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Word Scramble Game - Results</title>
</head>

<body>
    <h1>Game Over</h1>
    <p>Name: <?= $name; ?></p>
    <p>Score: <?= $score; ?> / <?= $max_score; ?> (<?= "$score_percent%"; ?>)</p>
    <h2>Round Summary</h2>
    <ul>
        <?php foreach ($guesses as $guess): ?>
            <li>
                Round <?= $guess['round']; ?>:
                <?php if ($guess['correct']): ?>
                    Correct. The word was "<?= $guess['word']; ?>".
                <?php else: ?>
                    Incorrect. The word was "<?= $guess['word']; ?>".
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="start.php">Play Again</a> | <a href="leaderboard.php">View Leaderboard</a>
    </body>

</html>