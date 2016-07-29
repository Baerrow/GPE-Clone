<?php
$pageTitle = "Liste des Partiels";
include_once('templates/header.php');
include_once('php/checkLogin.php');
include_once('php/tools/s_echo.php');
include_once('php/tools/enums/ExamStatus.php');

include_once('php/listToDoExam.php');
$toDoExams = getExamsToDo($database);
?>

<div class="container vertical-offset-50">
	<div class="page-header">
		<h2>Liste des partiels restants</h2>
	</div>
	<?php include('templates/alerts.php') ?>
	<table class="table table-hover tableListe">
		<thead>
			<tr class="info">
				<th>ID</th>
				<th>Nom</th>
				<th>Matière</th>
				<th>Professeur</th>
				<th>Statut</th>
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
				?>
				<td>
					<?php if($toDoExam["status"] == ExamStatus::OPEN) { ?>
					<a href="answerExam.php?id=<?php s_echo($toDoExam["id"]); ?>">
					<button type="button" class="btn btn-success" aria-label="Left Align"><b>Commencer</b>
					</button>
					</a>
					<?php } else { ?>
					<button type="button" class="btn btn-danger" aria-label="Left Align"><b>Clos</b> </button>
					<?php } ?>
				</td>
				<?php
				echo '</tr>';
			}
			?>
		</tbody>

	</table>
	<?php include('templates/footer.php') ?>
