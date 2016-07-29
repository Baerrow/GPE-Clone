<?php
	if (!isset($_SESSION['login']) || !$_SESSION['login'])
		header('Location: login.php?msg-warn=Vous n\'avez pas accès à cette page.');