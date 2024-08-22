# HOW DID I MADE THIS?
This **Quiz App** is made using following languages: HTML, CSS and JS for client side scripting and PHP for server side scripting.
## Database Structure
### Table: questions
    CREATE TABLE questions(
     id INT PRIMARY KEY AUTO_INCREMENT,
     question_id INT,
     questions VARCHAR(255),
     option_a VARCHAR(255),
     option_b VARCHAR(255),
     option_c VARCHAR(255),
     option_d VARCHAR(255)
    );

### Table: answer
    CREATE TABLE answer(
    id INT PRIMARY KEY AUTO_INCREMENT,
    answer_id INT,
    answer VARCHAR(255),
    question_id INT REFERENCE questions(question_id)
    );
The program works like this:
1. The random number is generated using php rand function which takes argument starting and ending number of question_id, so that every time user clicks **Next Question** button the random question is fetched from database.
2. Questions, options and correct answer is fetched from database using query
3.      SELECT * FROM questions INNER JOIN answer ON questions.question_id = answer.question_id WHERE question.question_id = '$randNum';
4. After the query is executed and data is fetched from database the question and four options are displayed. Example code to display one of the option:
5.      <input type="radio" name="answer-btn" id="a" value="<?php echo $row['option_a']; ?>"><label for="a"><?php echo $row['option_a']; ?></label>
6. On **Next Question** button click, the `storeProgress();` function is called.
    
    - The option choosed by user is retrived
    - The question is stored in js variable.
            
          var question = <?php echo json_encode($row["question"]); ?>;
         > json_encode function is because we can not directly assign string data type value fetched from db in js variable.
    
    - Correct answer is also stored in js variable
    - To keep track of question asked to user and correct answer of corresponding question browser's `local storage` is used to store `object`
    - Access previously stored `object` named   `quizProgress` from `local storage` 
        
          var progress = localStorage.getItem("quizProgress");

    - If there is no any previously stored `object` as in the case of `reset` or first time running program, assign new object to `progress` variable else assign existing object.
    
            if (progress == null) {
                progress = {};
            } else {
                progress = JSON.parse(progress);
            }
    - Add/Update progress in `object`, store `object` in `local storage` and `reload` to show next question to user
    
            progress[question] = { userAnswer: checkedAns, correctAnswer: correctAns };
            localStorage.setItem("quizProgress", JSON.stringify(progress));
            window.location.reload();

7. The page is reloded and same task is repeated again.
8. When user wishes to quit and viwe the score, he/she clickes in **Finish Quiz** button and user is navigated to another page where:
    - The `object` ,where the progress is stored, is passed to php file (to show in table) using the hidden input field.
    - When user clicks **View All Answers** button the `object stored in browser's local storage` is set to hidden input type and form is submitted. 
    -       <form action="showCorrectAnswer.php" method="POST">
                 <input type="hidden" name="localobject" id="localobject">
                <input type="submit" onclick="getLocalObject();"  name="submit" value="View full answer">
            </form>
            <script>
                function getLocalObject(){
                var progress = localStorage.getItem("quizProgress");
                document.getElementById("localobject").value=progress;
                }
                </script>

9. When user clicks **View All Answers** button, they are redirected to `showCorrectAnswer.php` where: 

    - The passed object is get and decoded to use as php's stdClass Object
    - The stdClass Object is traversed and Questions along with Correct Answer is displayed
    - The `Reset` button is used to delete local storage object to start new quiz and store progress. 