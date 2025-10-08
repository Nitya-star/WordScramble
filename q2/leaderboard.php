<?php
require_once './includes/library.php';
$pdo = connectdb();

// Fetch top 10 scores
$query = "select name, score, play_percent, played_at from 3430_a1q2_scores order by score desc, played_at desc limit 10";
$stmt = $pdo->prepare($query);
$stmt->execute();
$scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Word Scramble Game - Leaderboard</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
    <h1>Leaderboard</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Score</th>
            <th>Percentage</th>
            <th>Date Played</th>
        </tr>
        <?php foreach ($scores as $score): ?>
            <tr>
                <td><?= $score['name']; ?></td>
                <td><?= $score['score']; ?></td>
                <td><?= $score['play_percent']; ?></td>
                <td><?= $score['played_at']; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>