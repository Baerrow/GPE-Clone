<?php
$pageTitle = "Liste des Partiels";
include_once('templates/header.php');
include_once('php/checkLogin.php');
include_once('php/tools/s_echo.php');

include_once('php/listToDoExam.php');
$toDoExams = getToDoExams($database);
?>

<div class="container vertical-offset-50">
	<div class="page-header">
		<h2>Liste des partiels faits</h2>
	</div>
	<?php include('templates/alerts.php') ?>
	<table class="table table-hover tableListe">
		<thead>
			<tr class="info">
				<th>ID</th>
				<th>Nom</th>
				<th>Matière</th>
				<th>Professeur</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($toDoExams as $toDoExam)
			{
				echo '<tr>';
				echo '<td>'.$toDoExam["id"].'</td>';
				echo '<td>'.$toDoExam["examlabel"].'</td>';
				echo utf8_encode('<td>'.$toDoExam["subjectlabel"].'</td>');
				echo '<td>'.$toDoExam["firstname"].' '.$toDoExam["lastname"].'</td>';
				echo '</tr>';
			}
			?>
		</tbody>

	</table>
	<?php include('templates/footer.php') ?>
