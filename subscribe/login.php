<?php
session_start();
include "../Templates/header.php";
require_once "../Model/UsersRepository.php";
require_once "../Model/UsersLoginRepository.php";
require_once "../Model/Database.php";
require_once "../Model/Masters.php";
require_once "../Model/config.php";
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = new UsersLoginRepository();
    $getLogin = $login->getUsertoLogin($email, $password);
    if ($getLogin && password_verify($password, $getLogin['password'])) {

        if (!empty($getLogin['idpetSitter'])) {
            $SESSION['user']['id'] = $getLogin['idpetSitter'];
        } else {
            $SESSION['user']['id'] = $getLogin['idmaster'];
        }
            $SESSION['user']['role'] = $getLogin['role'];
    } else if (!empty($password && !empty($email))) {
        echo "<center>Les informations saisies n'ont pas permi de vous identifier. Veuillez vérifier vos informations</center>";
    }
    }

?>
<form method="post">
    <h1>Connectez-vous</h1>
    <input type="text" name="email" placeholder = "Votre email">
    <input type="password" name="password" placeholder = "Votre mot de passe">
    <input type="submit">
<?php include "../Templates/footer.php";?>