<?php
$pageTitle = "&Eacute;tudiants à valider";
include_once('templates/header.php');
include_once('php/checkLogin.php');
include_once('php/checkUserTypeProf.php');
include_once('php/listStudent.php');
include_once('php/tools/s_echo.php');
include_once('php/tools/enums/StudentStatus.php');

$students = getStudents($database);

?>

<div class="container vertical-offset-50">
    <div class="page-header">
        <h2 >&Eacute;tudiants en attente de validation</h2>
    </div>
    <?php include_once('templates/alerts.php'); ?>

    <table class="table table-hover tableListe">
        <thead>
        <tr class="info">
            <th>Nom</th>
            <th>Pr&eacute;nom</th>
            <th>Classe</th>
            <th></th>
        </tr>

        </thead>

        <tbody>
        <?php foreach ($students as $student) { ?>
            <tr>
                <td><?php s_echo($student['fname']) ?></td>
                <td><?php s_echo($student['lname']) ?></td>
                <td><?php s_echo($student['class']) ?></td>
                <td>
                    <?php if($student['status'] == StudentStatus::WAITING) { ?>
                        <form action="php/updateStudent.php" method="post">
                            <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                            <button class="btn btn-default" type="submit">Valider</button>
                        </form>
                    <?php }?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php include('templates/footer.php'); ?>
