<?php
$pageTitle = "Création de Partiel";
include_once('templates/header.php');
include_once('php/checkLogin.php');
include_once('php/checkUserTypeProf.php');
include_once('php/createExam.php');
$subjects = getSubjects($database);
$classes = getClasses($database);
?>


<div class="container">
    <h2> Création d'un partiel </h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nameExam">Nom :</label>
            <input type="text" class="form-control" value="" name="nameExam"/>
        </div>

        <div class="form-group">
            <label for="subjectExam">Matière :</label>
            <select class="form-control" name="subjectExam">
                <option value=""></option>
                <?php
                foreach ($subjects as $subject) {
                    echo '<option value="' . $subject["id"] . '">' . utf8_encode($subject["label"]) . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="classExam">Classe : </label>
            <select class="form-control" name="classExam">
                <option value=""></option>
                <?php
                foreach ($classes as $class) {
                    echo '<option value="' . $class["id"] . '">' . $class["label"] . '</option>';
                }
                ?>
            </select>
        </div>

        <input type="submit" value="Valider"/>
    </form>
<?php
include_once('templates/footer.php');
?>
</div>

