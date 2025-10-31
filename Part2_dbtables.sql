

CREATE TABLE 3430_a1q2_scores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  score INT NOT NULL,
  play_percent INT NOT NULL,
  played_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE 3430_a1q2_words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(50) NOT NULL,
    difficulty ENUM('easy', 'medium', 'hard') NOT NULL
);

INSERT INTO 3430_a1q2_words (word, difficulty) VALUES
-- Easy words
('cat', 'easy'),
('dog', 'easy'),
('sun', 'easy'),
('book', 'easy'),
('pen', 'easy'),
('hat', 'easy'),
('fish', 'easy'),
('ball', 'easy'),
('tree', 'easy'),
('car', 'easy'),
('cup', 'easy'),
('shoe', 'easy'),
('bird', 'easy'),
('rain', 'easy'),
('milk', 'easy'),
('egg', 'easy'),
('star', 'easy'),

-- Medium words
('plane', 'medium'),
('train', 'medium'),
('cloud', 'medium'),
('mouse', 'medium'),
('phone', 'medium'),
('water', 'medium'),
('light', 'medium'),
('apple', 'medium'),
('banana', 'medium'),
('school', 'medium'),
('window', 'medium'),
('flower', 'medium'),
('circle', 'medium'),
('letter', 'medium'),
('pencil', 'medium'),
('guitar', 'medium'),

-- Hard words
('elephant', 'hard'),
('calendar', 'hard'),
('chocolate', 'hard'),
('sunflower', 'hard'),
('pineapple', 'hard'),
('notebook', 'hard'),
('backpack', 'hard'),
('language', 'hard'),
('keyboard', 'hard'),
('mountain', 'hard'),
('airplane', 'hard'),
('dinosaur', 'hard'),
('triangle', 'hard'),
('umbrella', 'hard'),
('laughter', 'hard'),
('painting', 'hard'),
('sandwich', 'hard');
