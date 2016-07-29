<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title> <?php echo $pageTitle; ?> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
<?php
   include_once('php/tools/enums/UserType.php');
?>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><image src="img/logo.min.png"/></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse" style="padding-top: 6px">
                    <?php
                    if (empty($_SESSION)) {
                    ?>
                        <ul class="nav navbar-nav">
                            <li><a href="registration.php">S'inscrire</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="login.php">Se connecter</a></li>
                        </ul>
                        <?php } else { ?>
                        <ul class="nav navbar-nav">
                            <?php if ($_SESSION['role'] == UserType::PROFESSOR) { ?>
                                <li><a href="createQuestions.php">Créer des questions</a></li>
                                <li><a href="listStudent.php">Valider des élèves</a></li>
                            <?php } ?>
                            <li><a href="listExam.php">Voir les partiels</a></li>
                            <?php if ($_SESSION['role'] == UserType::STUDENT) { ?>
                            <li><a href="listToDoExam.php">Voir les partiels à faire</a></li>
                            <?php } ?>
                            <li><a href="listSubject.php">Liste des matières</a></li>
                        </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="php/logout.php">Se déconnecter</a></li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>
