# Word Scramble Game

This project demonstrates backend web development skills using PHP, MySQL, and session management. It combines form handling, data processing, and database interaction to create dynamic, interactive web pages while maintaining valid, semantic, and accessible HTML.

## Overview

This project, titled WordScramble, includes two major parts:
1. **Form Processing with PHP String & Array Functions:** Showcasing data handling, validation, and array manipulation using core PHP functions. 
2. **Word Scramble Game:** A session-based game integrated with a database for persistent storage and leaderboard functionality.

## Features

1. **Form Processing**
   * **User Input Form:** Collects a sentence and two words from the user.
   * **String Manipulation:** Converts text to lowercase, trims whitespace, replaces specific words, and counts occurences.
   * **Array Operations:** Split text into words, removes duplicates, sorts alphabetically, counts unique entries, and identifies the longest word.
   * **Formatted Output:** Presents results using semantic HTML with clean. readable formatting.
2. **Word Scramble Game**
   * **Gameplay Logic:** Randomly scrambles words for the user to guess, with difficulty-based scoring and round limits (3, 5 or 10).
   * **Session Management:** Stores player name, game progress, and round data using PHP sessions.
   * **Database Integration:** Records player scores, dates, and statistics using SQL queries.
   * **Leaderboard:** Displays the top 10 scores dynamically from the database in a well-formatted table.
   * **Optional Hint Feature:** Allows one hint per round, re-enabled for each new word.

## Code Structure

* **start.php:** Initializes sessions, collects user name, and starts the game.
* **play.php:** Contains main game logic, word randomization, and score calculation.
* **results.php:** Displays final score summary and saves results to the database.
* **leaderboard.php:** Fetches and displays top player results.
* **form.php:** Implements the string and array manipulation task.
* **database.sql:** Defines database schema and tables with words for the game.
* **testing.md:** Includes testing documentation and output validation.

## How to Use

1. Clone or download the repository.
2. Upload the files to a PHP-enabled server (such as Loki).
3. Import the database.sql file to set up the MySQL database.
4. Open start.php in a browser to begin the game, or form.php to test string and array functions.

## Technical Skills Demonstrated

* **Backend Development:** PHP (form handling, session management, database conectivity)
* **Database Mangement:** MySQL (queries, schema design, CRUD operations)
* **Frontend Integration:** HTML5, CSS3 for layout and accessibility
* **Accessibility & Semantics:** WCAG concepts, valid HTML structure, color contrast
* **Testing & Validation:** Input validation, browser testing, and functional verification
* **Version Control:** Git and GitHub for version tracking and submission management

## Purpose

This project was completed as part of COIS 3430 - Web Development: Backend at Trent University. It demonstrates my ability to build dynamic, database-driven applications using PHP and MySQL, apply session handling and state management, and ensure semantic, accessible, and maintainable web development practices consistent with real-world standards.