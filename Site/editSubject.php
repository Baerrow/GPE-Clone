<?php
$pageTitle = "Modification de matière";
include_once('templates/header.php');
include_once('php/checkLogin.php');
include_once('php/checkUserTypeProf.php');
include_once('php/editSubject.php');
include_once('php/tools/s_echo.php');

$id = $_GET['id'];
$subject = getSubject($database, $id);
$classes = getClasses($database);

?>


<div class="container">
    <h2> Modification d'une matière </h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nameSubject">Nom :</label>
            <input type="text" class="form-control" value="<?php s_echo($subject["label"]); ?>" name="nameSubject"/>
        </div>
        <select class="form-control" name="classSubject">
            <option value=""></option>
            <?php foreach ($classes as $class): ?>
                <option value="<?php s_echo($class["id"]); ?>"
                        <?php if ($class["id"] == $subject["id_class"]): ?> selected="selected"<?php endif; ?>
                        >
                            <?php s_echo($class["label"]); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <br>

        <input type="submit" class="btn btn-default" value="Valider"/>
    </form>
    <?php
    include_once('templates/footer.php');
    ?>
