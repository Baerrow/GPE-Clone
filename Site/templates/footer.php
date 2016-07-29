<!-- Footer -->
<footer>
    <hr>
    <p class="secondary">Copyright 2012-<?php echo date('Y') ?> © EPSI-GPE
    <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] == UserType::PROFESSOR)
            print_r(" - Connecté en tant que professeur");
        else if (isset($_SESSION['role']) && $_SESSION['role'] == UserType::STUDENT)
            print_r(" - Connecté en tant qu'élève");
    ?>
    </p>
</footer>
</div>
</body>
</html>
