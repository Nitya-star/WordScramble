<?php 

// getting contents entered by the user
$sentence = $_POST['sentence'] ?? "";
$word1 = $_POST['tobereplace'] ?? "";
$word2 = $_POST['replaceby'] ?? "";

// declare errors array
$errors = array();

// if form has been submitted
if (isset($_POST['submit'])) {
    
    // if sentence is empty
    if (empty($sentence)) {
        $errors['sentence'] = true;
    }
    // if word to be replaced is empty
    if (empty($word1)) {
        $errors['tobereplace'] = true;
    }
    // if word going to replace is empty
    if (empty($word2)) {
        $errors['replaceby'] = true;
    }
    // if no errors
    if (empty($errors)) {
    // converting to lowercase
    $sentence = strtolower($sentence);
    $word1 = strtolower($word1);
    $word2 = strtolower($word2);
    
    // trimming the whitespace
    $sentence = trim($sentence);
    $word1 = trim($word1);
    $word2 = trim($word2);

    // replacing occurences of word1 with word2
    $new_sentence = str_replace($word1, $word2, $sentence);

    // counting the occurences of word2 in new sentence
    $word2_occurence = substr_count($new_sentence, $word2);

    // Part2
    // splitting the new sentence into individual words
    $words = explode(" ", $new_sentence);

    // removing all duplicate words from the array
    $different_words = array_unique($words);

    // sorting the returning array of above function
    sort($different_words);

    // counting the number of words in the unique array
    $different_words_count = count($different_words);

    // identifying the longest word in the array
    $longest_word = "";
    foreach($different_words as $word) {
        if (strlen($word) > strlen($longest_word)) {
            $longest_word = $word;
        }
    }

    // converting final array back into single string with words separated by commas
    $final_string = implode(", ", $different_words);

    // grouping words by their first letter
    $grouped_words = [];
    foreach ($different_words as $word) {
        if ($word === '') continue;
        $first_letter = strtolower(substr($word, 0, 1));
        $grouped_words[$first_letter][] = $word;
    }
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
    <h1>Question 1</h1>
    <section>
      <h2>Getting Some Data</h2>
      <form method="post">
        <div>
          <label for="sentence">Enter a sentence:</label>
          <input type="text" name="sentence" id="sentence" value="<?= $sentence ?>"/>
          <span class="error <?= isset($errors['sentence']) ? '' : 'hidden'?>">
            You must enter the sentence.
          </span>
        </div>
        <div>
          <label for="tobereplace">Enter a word you want to replace in the above sentence:</label>
          <input type="text" name="tobereplace" id="tobereplace" value="<?= $word1 ?>"/>
          <span class="error <?= isset($errors['tobereplace']) ? '' : 'hidden'?>">
            You must enter a word which you want to replace.
          </span>
        </div>
        <div>
          <label for="replaceby">Enter the word you want the selected word to be replaced by:</label>
          <input type="text" name="replaceby" id="replaceby" value="<?= $word2 ?>"/>
          <span class="error <?= isset($errors['replaceby']) ? '' : 'hidden'?>">
            You must enter a word to replace the word entered above.
          </span>
        </div>
        <div>
          <button type="submit" name="submit">Submit</button>
        </div>
      </form>
    </section>
<?php if((empty($errors)) && (isset($_POST['submit']))) : ?>
    <h2>Results</h2>
    <h3>Part 1</h3>
    <p><?= "The new sentence after modification is: '$new_sentence'." ?></p>
    <p><?= "The second word provided appears '$word2_occurence' time/s in the new sentence." ?></p>
    <h3>Part 2</h3>
    <p><?= "The total number of unique words in the sentence is '$different_words_count'." ?></p>
    <p><?= "The longest word in the array is '$longest_word'." ?></p>
    <p><?= "All the words in the string arranged in alphabetical order are '$final_string'." ?></p>
    <p><?= "The groups of words according to first letter are as follows:"?></p>
    <?php foreach ($grouped_words as $letter => $words): ?>
    <p><?= "'$letter':" ?> <?= implode(', ', $words)?></p>
    <?php endforeach; ?>
<?php endif ?>
</body>
</html>

