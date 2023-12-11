<?php
session_start();
require 'templates/header-var.php';
require_once "Model/Database.php";
require_once "Model/PetSittersRepository.php";
require_once "Model/config.php";
require_once "Model/Reservation.php";
require_once "Model/ReservationRepository.php";
if (empty($_SESSION['user'])) {
  header('Location:login.php');
}
$servicePetSitterRepository = new PetsittersRepository();
$idPetSitter = $_SESSION['search']['idpetSitter'];
$idService = $_SESSION['search']['type'];
$idMaster = $_SESSION['user']['id'];
$servicePetSitter = $servicePetSitterRepository->getPriceService($idPetSitter, $idService);
$startDate = $_SESSION['search']['startDate'];
$endDate = $_SESSION['search']['endDate'];
$startDateTime = new DateTime($startDate); 
$endDateTime = new DateTime($endDate);
$diffDays = $endDateTime->diff($startDateTime);
$nbDays = $diffDays->d;
$totalPrice = $servicePetSitter['price'] * $nbDays;
if (!empty($_POST)) {
  if (empty($_POST['description'])) {
    $errorMessage = "Veuillez remplir un message pour le Pet Sitter.";
  } else {
    $description = $_POST['description'];
    $reservation = new Reservation($startDate, $endDate, $totalPrice, 'En attente', $description, $idService, $idMaster, $idPetSitter);
    $insertReservation = new ReservationRepository();
    $insertReservation->insertRow($reservation);
    header('Location:confirmReservation.php');
  }
}



?>

<div class="container-lg ">
  <h2 class="mb-3 pt-5">Récapitulatif de réservation :</h2>
  <?php if (!empty($errorMessage)):?>
                <div class="alert alert-danger" role="alert"><?=$errorMessage?></div>
             <?php endif;?>
    <form method="post">
      <div class="row">
      <!-- Réservation à venir -->

      <div class="col-md-6">
          <div class="card rounded-4 shadow border-0 px-4 py-4 mt-4">
            <div class="card-body pb-3">
              <label for="exampleFormControlTextarea1" class="card-text fw-medium">Votre message à destination du pet sitter :</label>
              <textarea class="form-control mt-4" id="exampleFormControlTextarea1" rows="3" style="height: 228px;" name="description"></textarea>
            </div>
        </div>
        </div>

      <div class="col-md-6">
          <div class="card rounded-4 shadow border-0 px-4 py-4 mt-4">
          <div class="card-body pb-3">
                  
              <div class="d-flex align-items-center mb-3 fw-bold">
                <div class="circle p-2 me-2"></div>
                <div class="p-2">
                Statut: en attente de validation 
                </div>
              </div>

              <div class="mb-3">
                <p class="card-text fw-medium">Type de prestation: <?= $servicePetSitter['serviceType'] ?></p>
                <p class="card-text fw-medium">Date de début: <?= date('d-m-Y', strtotime($startDate)) ?></p>
                <p class="card-text fw-medium">Date de fin : <?= date('d-m-Y', strtotime($endDate)) ?></p>
                <p class="card-text fw-bold">Prix total: <?= $totalPrice ?>€</p>
              </div>
                  
              <hr>

              <div class="d-flex align-items-center pt-2">
                <div class="p-2">
                  <img src="data:image/jpeg;base64,<?= $servicePetSitter['image']?>" class="rounded-image" alt="Avatar">
                </div>
                <div class="p-2 user-name ms-3">
                <?= $servicePetSitter['firstName'] ?>
                </div>
              </div>
          </div>
        </div>
        </div>
      <!-- Card conteneur -->
  </div>

    <div class="row">
      <div class="col-md-12">
        <div class="p-2 ms-auto mt-4">
        <input type="submit" class="btn btn-primary mt-3 mb-5  " value="Confirmer ma demande">
        </div>
      </div>
    </div>
  </div>
</form>