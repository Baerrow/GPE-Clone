<?php
	include_once('database/getDatabase.php');
	include_once('php/tools/getFromArray.php');

	const SQL_GET_TO_DO_EXAMS_STUDENT = "SELECT exams.id, exams.id_subject, exams.label AS examlabel, subjects.label AS subjectlabel, users.firstname AS firstname, users.lastname AS lastname  
		FROM exams
		INNER JOIN subjects
		ON exams.id_subject = subjects.id
		INNER JOIN users
		ON users.id = exams.id_user
		WHERE id_class = $
		AND mark.id_user = 
		AND exams.id IN (
			SELECT id_exam FROM marks
			GROUP BY id_exam
		);";

const SQL_GET_TO_DO_EXAMS_PROF = "SELECT exams.id, exams.id_subject, exams.label AS examlabel, subjects.label AS subjectlabel, users.firstname AS firstname, users.lastname AS lastname  
		FROM exams
		INNER JOIN subjects
		ON exams.id_subject = subjects.id
		INNER JOIN users
		ON users.id = exams.id_user
		WHERE exams.id NOT IN (
			SELECT id_exam FROM marks
			GROUP BY id_exam
		);";

	$database = getDatabase();
	function getToDoExams($database) {
		if(isset($_SESSION['class'])) {
			$sth = $database->prepare(SQL_GET_TO_DO_EXAMS_STUDENT);
			$sth->execute(array(":id_class" => $_SESSION['class']));
		} else {
			$sth = $database->query(SQL_GET_TO_DO_EXAMS_PROF);
		}


		return $sth->fetchAll();
	}
	function idclass($database, $user_id)
	{
	    $sth = $database->prepare(SQL_EDIT_SUBJECT);
	    $sth->execute(array($_SESSION['id_user'] => $id_class));
	    return $sth->fetch();  
	    
	}
?>