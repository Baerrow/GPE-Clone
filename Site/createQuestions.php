<?php
    $pageTitle = "Création de Partiel";
    include_once('templates/header.php');
    include_once('php/checkLogin.php');
    include_once('php/checkUserTypeProf.php');
    include_once('php/createQuestions.php');

    $exams = getExams($database);
?>

<div class="container">
    <h2> Questions du partiel </h2><br>
    <?php include_once('templates/alerts.php') ?>
    <div>
        <form action="" method="POST">
            <input type="hidden" name="msg-ok" value="La question a été correctement ajoutée !"/>

            <select name="idExam" class="form-control">
                <?php
                    foreach($exams as $exam){ ?>
                        <option value="<?php echo $exam['id'] ?>" <?php (isset($_POST['idExam']) && $_POST['idExam'] == $exam['id']) ? print_r('selected') : print_r('') ?>><?php echo $exam['label'] ?></option>
                <?php }
                ?>
            </select>
            <br>

            <div class="form-group">
                <label for="labelQuestion">Libellé :</label>
                <input type="text" class="form-control" value="" name="labelQuestion" id="labelQuestion" placeholder="Libellé de la question" required />
            </div>

            <div class="form-group">
                <label for="points">Nombre de points pour une bonne réponse: </label>
                <select class="form-control" name="points" id="points" required>
                    <option value="1" selected>1</option>
                    <?php
                    for ($i=2; $i <= 20; $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                </select>
            </div>

            <hr>

            <div class="form-group">
                <label for="typeResponse">Type de réponse : </label>
                <select class="form-control" name="typeResponse" id="typeResponse" required>
                    <option value="0" selected>Réponse libre</option>
                    <option value="1">Réponse à choix multiple</option>
                </select>
            </div>

            <div id="responseBlockRadio" class="hidden">

                <div class="form-group">
                    <label for="option1">Réponse 1 :</label>
                    <input type="text" class="form-control" value="" name="option1" id="option1" placeholder="Valeur de la bonne réponse" />
                </div>

                <div class="form-group">
                    <label for="option2">Réponse 2 :</label>
                    <input type="text" class="form-control" value="" name="option2" id="option2" placeholder="Valeur de la bonne réponse" size="2" />
                </div>

                <div class="form-group">
                    <label for="option3">Réponse 3 :</label>
                    <input type="text" class="form-control" value="" name="option3" id="option3" placeholder="Valeur de la bonne réponse" />
                </div>

                <div class="form-group">
                    <label for="option4">Réponse 4 :</label>
                    <input type="text" class="form-control" value="" name="option4" id="option4" placeholder="Valeur de la bonne réponse" />
                </div>

            </div>

            <hr>

                <div class="form-group">
                    <label for="right_answer">Bonne réponse :</label>
                    <input type="text" class="form-control" value="" name="right_answer" id="right_answer" placeholder="Valeur de la bonne réponse" required />
                </div>

            <input class="btn btn-default" type="submit" value="Ajouter"/>
        </form>
    </div>
    
<?php
    include_once('templates/footer.php');
?>
</div>

<script type="text/javascript">

    $( "#typeResponse" ).change(function() {
        var typeResponse = document.getElementById("typeResponse").value;
        var answerRadio = 1;

        if(typeResponse == answerRadio) {
            $('#responseBlockRadio').removeClass("hidden");
        }
        else {
            $('#responseBlockRadio').addClass("hidden");
            for (var i = 1; i < 5; i++) {
                $('#option'+i).val('');
            }
        }
    });


</script>
