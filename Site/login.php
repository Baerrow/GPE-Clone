<?php
$pageTitle = "Connexion";
include_once('templates/header.php');

if (!empty($_SESSION))
{
    header('Location: listExam.php');
}

?>

    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row-fluid user-row">
                        <img src="img/logo.png" class="img-responsive"/>
                    </div>
                </div>
                <div class="panel-body">
                    <?php include('templates/alerts.php') ?>
                    <form role="form" class="form-signin" action="php/login.php" method="POST">
                        <fieldset>
                            <p>Merci de saisir vos identifiants de connexion.</p>
                            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="true"/>
                            <br>
                            <input class="form-control" placeholder="Mot de passe" name="password" type="password"/>
                            <br>
                            <a href="registration.php">Vous n'avez pas de compte ?</a>
                            <br></br>
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Se connecter"/>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <?php
    include_once('templates/footer.php');
    ?>
</div>

