<?php
include_once('php/tools/enums/UserType.php');
if ($_SESSION['role'] != UserType::PROFESSOR)
    header('Location: listExam.php?msg-warn=Vous n\'avez pas accès à cette page.');
