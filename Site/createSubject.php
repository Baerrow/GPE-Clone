<?php
$pageTitle = "Création de matière";
include_once('templates/header.php');
include_once('php/checkLogin.php');
include_once('php/checkUserTypeProf.php');
include_once('php/createSubject.php');

  $class = getClass($database);
?>


<div class="container">

    <h2> Création d'une matière </h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nameSubject">Nom :</label>
            <input type="text" class="form-control" value="" name="nameSubject"/>
        </div>
        <select class="form-control" name="classSubject">
            <?php
                    foreach($class as $classes){ ?>
                        <option value="<?php echo $classes['id'] ?>"><?php echo $classes['label'] ?></option>
                <?php }
                ?>
        </select>
        <br/>
        <input type="submit" class="btn btn-primary" value="Valider"/>
    </form>
    <?php
    include_once('templates/footer.php');
    ?>
