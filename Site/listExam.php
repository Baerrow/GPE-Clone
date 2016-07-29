<?php
$pageTitle = "Liste des Partiels";

include_once('templates/header.php');
include_once('php/checkLogin.php');
include_once('php/tools/s_echo.php');
include_once('php/tools/enums/ExamStatus.php');
include_once('php/listExam.php');

$exams = getExams($database);
?>

<div class="container vertical-offset-50">
    <div class="page-header">
        <h2 >Liste des partiels</h2>
        <?php if ($_SESSION['role'] == UserType::PROFESSOR) { ?>
            <a href="createExam.php"> <button type="button" class="btn btn-success" aria-label="Left Align">
                    <span  class="glyphicon glyphicon-plus" aria-hidden="true"></span> <b>Nouveau</b>
                </button></a>
        <?php } ?>
    </div>
    <?php include_once('templates/alerts.php'); ?>

    <table class="table table-hover tableListe">
        <thead>
            <tr class="info">
                <?php if ($_SESSION['role'] == UserType::STUDENT) { ?>
                <th></th>
                <?php } ?>
                <th>Nom du partiel</th>
                <th style="text-align:center">Matière</th>
                <th style="text-align:center">Statut</th>
                <th style="text-align:center">Prof</th>
                <th style="text-align:center">Classe</th>
                <th style="text-align:center">Actions</th>
            </tr>

        </thead>

        <tbody>
            <?php foreach ($exams as $exam) { ?>
                <tr onclick="window.location = modifUser.php?id=<?php s_echo($exam["idExams"]); ?>">
                    <?php if ($_SESSION['role'] == UserType::STUDENT) { ?>
                    <td>
                        <?php if($exam["status"] == ExamStatus::OPEN) { ?>
                            <a href="answerExam.php?id=<?php s_echo($exam["idExams"]); ?>">
                                <button type="button" class="btn btn-success" aria-label="Left Align"><b>Commencer</b>
                                </button>
                            </a>
                        <?php } else { ?>
                            <button type="button" class="btn btn-danger" aria-label="Left Align"><b>Clos</b> </button>
                        <?php } ?>
                    </td>
                    <?php } ?>
                    <td><?php s_echo($exam["labelExams"]); ?></td>
                    <td style="text-align:center"><?php s_echo($exam["labelSubject"]); ?></td>
                    <td style="text-align:center"><?php echo ExamStatus::ToString($exam["status"]); ?></td>
                    <td style="text-align:center"><?php s_echo($exam["userFirstname"] . ' ' . $exam["userLastname"]); ?></td>
                    <td style="text-align:center"><?php s_echo($exam["labelClass"]); ?></td>
                    <td style="text-align:center">
                    <a href="editExam.php?id=<?php s_echo($exam['idExams']);?>">Modifier</a>&nbsp;
                    <a href="showCorrection.php?id_exam=<?php s_echo($exam['idExams']);?>">Correction</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php include('templates/footer.php'); ?>
