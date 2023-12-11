<?php
session_start();
require 'templates/header-var.php';
require_once "Model/Database.php";
require_once "Model/Masters.php";
require_once "Model/config.php";
require_once "Model/ReservationRepository.php";
$idMaster = $_SESSION['user']['id'];
$reservationRepository = new ReservationRepository();
$reservationsBeforeNow = $reservationRepository->getRowBeforeNow($idMaster, 'master_id');
$reservationsAfterNow = $reservationRepository->getRowAfterNow($idMaster, 'master_id');
?>

<div class="container-lg ">
  <h2 class="mb-5 pt-5">Mes réservations</h2>

    <div class="row">
    <!-- Réservation à venir -->
    <h5>A venir</h5>
    <!-- Card conteneur -->
    <?php if (empty($reservationsAfterNow)) : ?>
      <p> Aucune réservation à venir.</p>
    <?php endif ?>
    <?php foreach ($reservationsAfterNow as $reservationAfterNow) : ?>
      <div class="col-md-4">
          <div class="card rounded-4 shadow border-0 px-4 py-4 mt-4">
          <div class="card-body pb-3">

            <div class="d-flex align-items-center mb-3 fw-bold">
                <div class="circle p-2 me-2"></div>
                  <div class="p-2">
                    Statut: <?= $reservationAfterNow['status']?>
                  </div>
              </div>
          
              <div class="mb-3">
                  <p class="card-text fw-medium">Type de prestation : <?= $reservationAfterNow['serviceType']?></p>
                  <p class="card-text fw-medium">Date de début : <?= date('d-m-Y', strtotime($reservationAfterNow['startDate']))?></p>
                  <p class="card-text fw-medium">Date de fin : <?= date('d-m-Y', strtotime($reservationAfterNow['endDate']))?></p>
                  <p class="card-text fw-bold">Prix total: <?= $reservationAfterNow['totalPrice']?>€</p>
              </div>
                  
              <hr>

              <div class="d-flex align-items-center pt-2">
                  <div class="p-2">
                    <img src="data:image/jpeg;base64,<?= $reservationAfterNow['petSitterImage']?>" class="rounded-image" alt="Avatar">
                  </div>
                  <div class="p-2 user-name ms-3">
                    <?= $reservationAfterNow['FirstNamePetSitter']?>
                  </div>
                  <div class="p-2 ms-auto">
                      <input type="submit" class="btn-small btn-primary" value="Voir le profil">
                  </div>
              </div>
        </div>
      </div>
      </div>
    <?php endforeach ?>
    </div>

<div class="row py-5">

    <!-- Réservation à venir -->
    <h5>Passées</h5>
    <!-- Card conteneur -->
    <?php if (empty($reservationsBeforeNow)) : ?>
      <p> Aucune réservation passée.</p>
    <?php endif ?>
    <?php foreach ($reservationsBeforeNow as $reservationBeforeNow) : ?>
      <div class="col-md-4">
          <div class="card rounded-4 shadow border-0 px-4 py-4 mt-4">
          <div class="card-body pb-3">
          
              <div class="mb-3">
                  <p class="card-text fw-medium">Type de prestation : <?= $reservationBeforeNow['serviceType']?></p>
                  <p class="card-text fw-medium">Date de début : <?= $reservationBeforeNow['startDate']?></p>
                  <p class="card-text fw-medium">Date de fin : <?= $reservationBeforeNow['endDate']?></p>
                  <p class="card-text fw-bold">Prix total: <?= $reservationBeforeNow['totalPrice']?>€</p>
              </div>
                  
              <hr>

              <div class="d-flex align-items-center pt-2">
                  <div class="p-2">
                    <img src="data:image/jpeg;base64,<?= $reservationBeforeNow['petSitterImage']?>" class="rounded-image" alt="Avatar">
                  </div>
                  <div class="p-2 user-name ms-3">
                    <?= $reservationBeforeNow['FirstNamePetSitter']?>
                  </div>
                  <div class="p-2 ms-auto">
                      <input type="submit" class="btn-small btn-primary" value="Voir le profil">
                  </div>
              </div>
        </div>
      </div>
      </div>
    <?php endforeach ?>
</div>
</div>
<?php require_once "templates/footer.php"?>