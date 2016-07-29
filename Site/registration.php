<?php
$pageTitle = "Inscription";
include_once('templates/header.php');

include_once('php/registration.php');
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#role').change(function() {
            if ($('#role').val() == 'student')
                $('.class-select').css('display', 'block');
            else if ($('#role').val() == 'prof')
                $('.class-select').css('display', 'none');
        });
    });
</script>

<div class="container vertical-offset-50">
    <div class="page-header">
        <h2>Inscription</h2>
    </div>

    <?php include('templates/alerts.php') ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="firstName">Prénom</label>
            <input type="text" class="form-control" name="firstName" placeholder="Prénom" required>
        </div>

        <div class="form-group">
            <label for="lastName">Nom</label>
            <input type="text" class="form-control" name="lastName" placeholder="Nom" required>
        </div>

        <div class="form-group" id="userType">
            <label for="role">Vous &ecirc;tes</label>
            <select name="role" id="role" class="form-control" required>
                <option value="prof">Professeur</option>
                <option value="student">&Eacute;tudiant</option>
            </select>
        </div>

        <div class="form-group class-select" style="display: none;">
            <label for="class">Classe</label>
            <select name="class" class="form-control" required>
                <?php foreach ($class as $clas) { ?>
                    <option value="<?php echo $clas['id'] ?>"><?php echo $clas['label'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Adresse mail</label>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <input type="submit" value="Enregistrer" class="btn btn-primary"/>
    </form>

    <?php include_once('templates/footer.php') ?>
