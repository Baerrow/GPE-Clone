<?php
    $points = 0;
    $totalPoints = 0;
    $pageTitle = "Correction du partiel";

    include_once('templates/header.php');
    include_once('php/checkLogin.php');
    include_once('php/tools/s_echo.php');
    include_once('php/showCorrection.php');
?>

<div class="container vertical-offset-50">
    <div class="page-header">
        <h2>Correction de <?php s_echo($exam["label_exams"]) ?></h2>
    </div>

    <?php include_once('templates/alerts.php'); ?>

   <table class="table table-hover tableListe">
        <thead>
            <tr class="info">
                <th>Question</th>
                <th>Bonne réponse</th>
                <th>Votre réponse</th>
                <th>Points obtenus</th>
                <th>Points question</th>
            </tr>
        </thead>
        <tbody>
            <?php

                foreach ($questions as $question)
                {
                    $totalPoints += $question["points"];
                    $correct = (strtolower($question["right_answer"]) == strtolower($question["user_choice"]));

                    echo('<tr>');
                    echo('<td><b>'.$question["label"].'</b></td>');
                    echo('<td>'.$question["right_answer"].'</td>');

                    if ($correct)
                    {
                        $points += $question["points"];
                        echo('<td style="color: green">'.$question["user_choice"].'</td>');
                        echo('<td style="color: green">'.$question["points"].'</td>');
                    }
                    else
                    {
                        echo('<td style="color: red">'.$question["user_choice"].'</td>');
                        echo('<td style="color: red">0</td>');
                    }

                    echo('<td>/'.$question["points"].'</td>');
                    echo('</tr>');
                }

            ?>
        </tbody>
    </table>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Votre note:</h3>
        </div>
        <div class="panel-body">
            <h1 style="text-align: center"><b><?php print_r($points.'/'.$totalPoints) ?></b></h2>
        </div>
    </div>

<?php include('templates/footer.php'); ?>
