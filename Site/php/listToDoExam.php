<?php
	include_once('database/getDatabase.php');
	include_once('php/tools/getFromArray.php');

	const SQL_GET_TO_DO_EXAMS_STUDENT = "SELECT exams.id, exams.id_subject, exams.label AS examlabel, subjects.label AS subjectlabel, users.firstname AS firstname, users.lastname AS lastname, exams.status
		FROM exams
		INNER JOIN subjects
		ON exams.id_subject = subjects.id
		INNER JOIN users
		ON users.id = exams.id_user
		INNER JOIN students
		ON exams.id_class = students.id_class
		WHERE students.id_user = :id_user
		AND exams.id NOT IN (
			SELECT id_exam FROM marks
			WHERE id_user = :id_user
			GROUP BY id_exam
		);";

	$database = getDatabase();
	function getToDoExams($database) {
		$sth = $database->prepare(SQL_GET_TO_DO_EXAMS_STUDENT);
		$sth->execute(array($_SESSION['class']));
		return $sth->fetchAll();
	}

		function getExamsToDo($database)
	{
	    $sth = $database->prepare(SQL_GET_TO_DO_EXAMS_STUDENT);
	    $sth->execute(array(":id_user" => $_SESSION['id_user']));
	    return $sth->fetchAll();  
	    
	}
?>
