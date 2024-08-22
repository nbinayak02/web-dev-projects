<!DOCTYPE html>
<html>

<head>
    <title>Quiz App</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <?php 

    include "connection.php";

    //generate random number
    $randQID = rand(200,223);

    $statement = "SELECT * FROM questions INNER JOIN answer ON questions.question_id = answer.question_id WHERE questions.question_id = '$randQID';";

    $result = $connection->query($statement);
    if($result->num_rows==1){
        $row=$result->fetch_assoc(); ?>
    <div class="container">
        <div class="question-container">
            <div class="question-text">
                <?php echo $row["question"]; ?>
            </div>
        </div>
<div class="answer-container">
        <div class="options opt-a" for="A">
            <input type="radio" name="answer-btn" id="A" value="<?php echo $row['option_a']; ?>"> <label for="A">
                <?php echo $row["option_a"]; ?>
            </label>
        </div>
        <div class="options opt-b">
            <input type="radio" name="answer-btn" id="B" value="<?php echo $row['option_b']; ?>"><label for="B">
                <?php echo $row["option_b"]; ?>
            </label>
        </div>
        <div class="options opt-c">
            <input type="radio" name="answer-btn" id="C" value="<?php echo $row['option_c']; ?>"> <label for="C">
                <?php echo $row["option_c"]; ?>
            </label>
        </div>
        <div class="options opt-d">
            <input type="radio" name="answer-btn" id="D" value="<?php echo $row['option_d']; ?>"><label for="D">
                <?php echo $row["option_d"]; ?>
            </label>
        </div>
    </div>
    </div>
    <button onclick="storeProgress();" class="nexxt">Next Question</button>
    <button><a href="showMarks.html">Finish Quiz</a></button>

    <script>

        // Get all the divs containing radio buttons
const divs = document.querySelectorAll('.options');
const audio = new Audio('answer.mp3');  
// Add a click event listener to each div
divs.forEach(div => {
  div.addEventListener('click', (event) => {
    // Check if the clicked element is a radio button
    if (event.target.type === 'radio') {
      // If it is, check the radio button
      event.target.checked = true;

    } else {
      // If it's not a radio button, find the first radio button within the div and check it
      const radioButton = div.querySelector('input[type="radio"]');
      if (radioButton) {
        radioButton.checked = true;
      }
    }
     // Remove the 'active' class from all divs
     divs.forEach(div => div.classList.remove('active'));

// Add the 'active' class to the clicked div
div.classList.add('active');
audio.play();
  });
});
        function storeProgress() {

          
            var ans = document.getElementsByName("answer-btn");
            var checkedAns = null;

            for (var i = 0; i < ans.length; i++) {
                if (ans[i].checked) {
                    var checkedAns = ans[i].value;
                    break;
                }
            }

            var question = <?php echo json_encode($row["question"]); ?>;
            var correctAns =  <?php echo json_encode($row["answer"]); ?> //we can't directly assign string data type in js variable so we have to perform json_encode

            var progress = localStorage.getItem("quizProgress");
            if (progress == null) {
                progress = {};
            } else {
                progress = JSION.parse(progress);
            }
            progress[question] = { userAnswer: checkedAns, correctAnswer: correctAns };
            localStorage.setItem("quizProgress", JSON.stringify(progress));

            window.location.reload();
        }
    </script>

    <?php
    }
    else {
        echo "Question not found";
    }
    $connection->close();
?>
</body>

</html>