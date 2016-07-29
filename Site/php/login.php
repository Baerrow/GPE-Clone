<?php
    session_start();

    include_once('../database/getDatabase.php');
    include_once('tools/enums/UserType.php');
    include_once('tools/enums/StudentStatus.php');

    $db = getDatabase();

    $sql = $db->prepare("SELECT * FROM users WHERE email = ?;");

    $sql->execute(array($_POST['email']));
    $user = $sql->fetch();

    var_dump($user);
    var_dump($_POST);
    if ($user != null && $user['password'] == $_POST['password'])
    {
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['role'] = $user['type'];

        if ($user['type'] == UserType::STUDENT){
            $sql = $db->prepare("SELECT * FROM students WHERE id_user = :id_user;");
            $sql->execute(array("id_user" => $user['id']));
            $class = $sql->fetch();

            if ($class['status'] == StudentStatus::WAITING){
                session_destroy();
                header('Location: login.php?msg-error=Vous êtes en attente de validation');
            }

            $_SESSION['class'] = $class['id_class'];
        }

        header('Location: ../listExam.php');
    }
    else
        header('Location: ../login.php?msg-error=Nom d\'utilisateur incorrect ou mot de passe invalide !');
