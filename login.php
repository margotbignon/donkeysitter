<?php
session_start();
include "Templates/header.php";
require_once "Model/UsersRepository.php";
require_once "Model/UsersLoginRepository.php";
require_once "Model/Database.php";
require_once "Model/Masters.php";
require_once "Model/config.php";
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = new UsersLoginRepository();
    $getLogin = $login->getUsertoLogin($email, $password);
    if ($getLogin && password_verify($password, $getLogin['password'])) {

        if (!empty($getLogin['idpetSitter'])) {
            $_SESSION['user']['id'] = $getLogin['idpetSitter'];
        } else {
            $_SESSION['user']['id'] = $getLogin['idmaster'];
        }
            $_SESSION['user']['role'] = $getLogin['role'];
    } else if (!empty($password && !empty($email))) {
        echo "<center>Les informations saisies n'ont pas permi de vous identifier. Veuillez vérifier vos informations</center>";
    }

    }

?>
<div class="d-flex align-items-center" style="height: 100%;">
<div class="container-lg">
    <div class="row mt-5">
        <div class="col-md-3"></div>

        <div class="col-md-6 align-items-center justify-content-center">
            <div class="bg-white shadow rounded-4 border-0 search-column py-5 px-5">
            <form method="post">
                <h1 class="text-hero-bold text-center">Connectez-vous</h1>
                <input type="text" name="email" placeholder = "Votre email" class="form-control mt-3 pt3 pb3">
                <input type="password" name="password" placeholder = "Votre mot de passe" class="form-control mt-3 pt3 pb3">
                <input type="submit" class="btn btn-primary w-100 mt-3">
            </div>
        </div>

        <div class="col-md-3"></div>

    </div>
</div>
</div>
<?php include "Templates/footer.php";?>