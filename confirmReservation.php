<?php
session_start();
include "Templates/header-var.php";
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

<div class="container-lg d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="row">
        <div class="col-md-2"></div>

        <div class="col-md-8 d-flex flex-column align-items-center justify-content-center">
            <div class="bg-white shadow rounded-4 border-0 search-column py-5 px-5">
                <div class="header-4 text-align-center justify-content-center">
                    <h4 class="text-center">Votre demande a bien été prise en compte. Vous pouvez la retrouver dans votre espace personnel.</h4>
                </div>
                <div class="text-center">
                <a href="reservationMaster.php" class="btn btn-primary mt-3">Mes réservations</a>
                </div>
            </div>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>

<?php include "Templates/footer.php";?>
