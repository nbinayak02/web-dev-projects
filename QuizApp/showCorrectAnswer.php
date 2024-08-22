<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            font-family: Verdana;
        }

        table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 1rem;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        th,
        td {
            padding: 12px 15px;
        }

        tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        button {
            display: block;
            width: 8rem;
            height: 2rem;
            background-color: #009879;
            cursor: pointer;
            border: 1px solid rgb(138, 137, 137);
        }
        a{
            text-decoration: none;
            color:white;
            font-size: 1rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <audio autoplay>
        <source src="background-music.mp3" type="audio/mpeg">
    </audio>    
    <?php
    $localobj=$_POST["localobject"];
    $progress=json_decode($localobj);
    // print_r($progress);
    // Assuming your stdClass object is stored in the $stdClassObject variable
    $stdClassObject = new stdClass();
    $stdClassObject = $progress; ?>

    <table>
        <thead>
            <tr>
                <th>Question ID</th>
                <th>Your Answer</th>
                <th>Correct Answer</th>
                <th>Result</th>
            </tr>
            <thead>
            <tbody>
                <?php 
                    foreach ($stdClassObject as $questionId => $questionData) { ?>
                <tr>
                    <td>
                        <?php echo $questionId;?>
                    </td>
                    <td>
                        <?php echo $questionData->userAnswer;?>
                    </td>
                    <td>
                        <?php echo $questionData->correctAnswer;?>
                    </td>
                    <td>
                        <?php $status = ($questionData->userAnswer == $questionData->correctAnswer)?"Correct":"Incorrect"; echo $status; ?>
                </tr>
                <?php
    }
?>
            </tbody>
    </table>
    <?php 
        $score=0;
        $total=0;

        foreach ($stdClassObject as $questionId => $questionData) { 
            $total++;
            if($questionData->userAnswer == $questionData->correctAnswer){
                 $score++;
            }
        }
        ?>
    <p>Your score is:
        <?php echo $score."/".$total; ?>
    </p>
    <p>Percentage:
        <?php echo $score/$total*100?>%
    </p>
    <button onclick="deleteP();"><a href="index.php">Reset</a></button>
    <script>
        function deleteP() {
            localStorage.removeItem("quizProgress");
        }
    </script>
</body>

</html>