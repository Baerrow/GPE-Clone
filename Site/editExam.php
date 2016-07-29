<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 25/05/16
 * Time: 08:45
 */

$pageTitle = "Modification d'un Partiel";
include_once('templates/header.php');
include_once('php/checkLogin.php');
include_once('php/checkUserTypeProf.php');
include_once('php/tools/s_echo.php');
include_once('php/editExam.php');

$exam = getExam($database, $id_exam);
$subjects = getSubjects($database);
$classes = getClasses($database);
?>


<div class="container">
    <?php include_once('templates/alerts.php');?>
    <h2> Modification d'un partiel </h2>
    <form action="" method="POST">
        <input name="id" value="<?php echo $id_exam;?>" type="hidden" />

        <div class="form-group">
            <label for="nameExam">Nom :</label>
            <input type="text" class="form-control" value="<?php s_echo($exam['label']); ?>" name="nameExam"/>
        </div>

        <div class="form-group">
            <label for="subjectExam">Matière :</label>
            <select class="form-control" name="subjectExam">
                <option value=""></option>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?php s_echo($subject["id"]);?>"
                        <?php if($subject["id"] == $exam["id_subject"]): ?> selected="selected"<?php endif;?>
                    >
                        <?php s_echo($subject["label"]);?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="classExam">Classe : </label>
            <select class="form-control" name="classExam">
                <option value=""></option>
                <?php foreach ($classes as $class): ?>
                    <option value="<?php s_echo($class["id"]);?>"
                        <?php if($class["id"] == $exam["id_class"]): ?> selected="selected"<?php endif;?>
                    >
                        <?php s_echo($class["label"]);?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="status">État :</label>
            <select class="form-control" name="status">
                <option value="<?php echo ExamStatus::OPEN; ?>"
                    <?php if(ExamStatus::OPEN == $exam["status"]): ?> selected="selected"<?php endif;?>>
                    Ouvert
                </option>
                <option value="<?php echo ExamStatus::CLOSED; ?>"
                    <?php if(ExamStatus::CLOSED == $exam["status"]): ?> selected="selected"<?php endif;?>>
                    Fermé
                </option>
            </select>
        </div>

        <input type="submit" class="btn btn-default" value="Valider"/>
    </form>
    <?php
    include_once('templates/footer.php');
    ?>
</div>
