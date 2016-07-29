<?php
$pageTitle = "Liste des Matières";

include_once('templates/header.php');
include_once('php/checkLogin.php');
include_once('php/tools/s_echo.php');
include_once('php/listSubject.php');

$subjects = getSubjects($database);
?>

<div class="container vertical-offset-50">
    <div class="page-header">

        <h2>Liste des mati&egrave;res</h2>
        <?php if ($_SESSION['role'] == UserType::PROFESSOR) { ?>
        <a href="createSubject.php"> <button type="button" class="btn btn-success" aria-label="Left Align">
                    <span  class="glyphicon glyphicon-plus" aria-hidden="true"></span> <b>Nouveau</b>
                </button></a>
        <?php } ?>

    </div>
    <?php include_once('templates/alerts.php'); ?>

    <table class="table table-hover tableListe">
        <thead>
            <tr class="info">
                <th>Label</th>
                <th>classe</th>
            </tr>

        </thead>

        <tbody>
            <?php foreach ($subjects as $subject) { ?>
                <tr>
                    <td><?php echo $subject["labelSubject"]; ?></td>
                    <td><?php s_echo($subject["labelClass"]); ?></td>
                    <?php if ($_SESSION['role'] == UserType::PROFESSOR) { ?>
                    <td><a href="editSubject.php?id=<?php s_echo($subject["idSubject"]); ?>">Modifier</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php include('templates/footer.php'); ?>
