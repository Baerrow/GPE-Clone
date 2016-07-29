<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 24/05/16
 * Time: 14:18
 */

$pageTitle = "Répondre à un partiel";
include_once('templates/header.php');
include_once('php/checkLogin.php');

include_once("php/answerExam.php");

$exam = getExam($database, $exam_id);
$questions = getQuestions($database, $exam_id);
?>

<div class="container">
    <h2>Répondre à un partiel</h2>
    <h3><?php s_echo($exam["label"]);?></h3>

    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $exam_id;?>"/>

        <?php foreach ($questions as $question): ?>
            <?php $fieldName = "answers[{$question['id']}]";?>

            <div class="form-group">
                <label for="<?php s_echo($fieldName);?>">
                    <?php s_echo($question["label"]); ?>
                </label>

                <?php if($question["type"] == QuestionType::TEXT): ?>
                    <input type="text" class="form-control" value="" name="<?php s_echo($fieldName);?>"/>

                <?php else: ?>
                    <?php for($i = 1; $i <= 4; $i++):?>
                    <?php if($question["option$i"] == null) break;?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="<?php s_echo($fieldName);?>" value="<?php echo $i;?>">
                            <?php s_echo($question["option$i"]); ?>
                        </label>
                    </div>
                    <?php endfor; ?>

                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <input type="submit" class="btn btn-default" value="Valider"/>
    </form>

<?php
include_once('templates/footer.php');
?>
