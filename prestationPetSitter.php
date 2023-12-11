<?php
session_start();
require 'templates/header-var.php';
require_once "Model/Database.php";
require_once "Model/Masters.php";
require_once "Model/config.php";
require_once "Model/ReservationRepository.php";
/*$idPetSitter = $_SESSION['user']['id'];*/
$idPetSitter = 16;
$reservationRepository = new ReservationRepository();
$reservationsBeforeNow = $reservationRepository->getRowBeforeNow($idPetSitter, 'petSitter_id');
$reservationsAfterNowStandBy = $reservationRepository->getRowAfterNowStandBy($idPetSitter);
$reservationsAfterNowConfirmed = $reservationRepository->getRowAfterNowConfirmed($idPetSitter);
if (!empty($_POST)) {
  $idReservation = $_POST['idreservation'];
  $updateReservation = new ReservationRepository ();
  if ($_POST['updateReservation'] === 'Je valide') {
    $updateReservation->updateStatus('Validée', $idReservation);
  } else {
    $updateReservation->updateStatus('Refusée', $idReservation);
  }
  header('Location:prestationPetSitter.php');
}
?>

<div class="container-lg ">
  <h2 class="mb-5 pt-5">Mes prestations</h2>

<!-- Réservation à venir -->
    <div class="row">

    <h5>A venir</h5>
    <!-- Card conteneur -->
    <?php if (empty($reservationsAfterNowConfirmed)) : ?>
      <p> Aucune réservation à venir.</p>
    <?php endif ?>
       <?php foreach ($reservationsAfterNowConfirmed as $reservationAfterNowConfirmed) : ?>
      <div class="col-md-4">
        <div class="card rounded-4 shadow border-0 px-4 py-4 mt-4">
        <div class="card-body pb-3">
            
            <div class="mb-3">
              <p class="card-text fw-medium">Type de prestation : <?=$reservationAfterNowConfirmed['serviceType']?></p>
              <p class="card-text fw-medium">Date de début : <?=date('d-m-Y', strtotime($reservationAfterNowConfirmed['startDate']))?></p>
              <p class="card-text fw-medium">Date de fin : <?=date('d-m-Y', strtotime($reservationAfterNowConfirmed['endDate']))?></p>
              <p class="card-text fw-bold">Prix total: <?=$reservationAfterNowConfirmed['totalPrice']?>€</p>
            </div>
                
            <hr>

            <div class="d-flex align-items-center pt-2">
              <div class="p-2">
                <img src="data:image/jpeg;base64,<?= $reservationAfterNowConfirmed['petSitterImage']?>" class="rounded-image" alt="Avatar">
              </div>
              <div class="p-2 user-name ms-3">
              <?= $reservationAfterNowConfirmed['FirstNameMaster']?>
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


<!-- En attente de validation -->

<div class="row py-5">
    <h5>En attente de validation</h5>
    <!-- Card conteneur -->
    <?php if (empty($reservationsAfterNowStandBy)) : ?>
      <p> Aucune réservation en attente.</p>
    <?php endif ?>
    <?php foreach ($reservationsAfterNowStandBy as $reservationAfterNowStandBy) : ?>
      <div class="col-md-4">
          <div class="card rounded-4 shadow border-0 px-4 py-4 mt-4">
              <div class="card-body pb-3">
              
              <div class="mb-3">
                  <p class="card-text fw-medium">Type de prestation : <?=$reservationAfterNowStandBy['serviceType']?></p>
                  <p class="card-text fw-medium">Date de début : <?=date('d-m-Y', strtotime($reservationAfterNowStandBy['startDate']))?></p>
                  <p class="card-text fw-medium">Date de fin : <?=date('d-m-Y', strtotime($reservationAfterNowStandBy['endDate']))?></p>
                  <p class="card-text fw-bold">Prix total: <?=$reservationAfterNowStandBy['totalPrice']?></p>
              </div>
              <form method='post'>
                <div class="d-flex align-items-center mb-3 fw-bold pb-3">
                  <div class="p-2">
                    <input type="hidden" value="<?=$reservationAfterNowStandBy['idreservation']?>" name="idreservation">
                    <input type="submit" class="btn-small btn-primary" value="Je valide" name="updateReservation">
                  </div>
                  <div class="p-2 ms-4">
                    <input type="submit" class="btn-small btn-secondary" value="Je refuse" name="updateReservation"> 
                  </div>
                </div>
            </form>
                  
              <hr>

              <div class="d-flex align-items-center pt-2">
                  <div class="p-2">
                    <img src="data:image/jpeg;base64,<?= $reservationAfterNowConfirmed['petSitterImage']?>" class="rounded-image" alt="Avatar">
                  </div>
                  <div class="p-2 user-name ms-3">
                    <?= $reservationAfterNowConfirmed['FirstNameMaster']?>
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



<!-- Passées -->

<div class="row py-5">
    <h5>Passées</h5>
    <!-- Card conteneur -->
    <?php if (empty($reservationsBeforeNow)) : ?>
      <p> Aucune réservation passée.</p>
    <?php endif ?>
    <?php foreach($reservationsBeforeNow as $reservationBeforeNow) : ?>
      <div class="col-md-4">
          <div class="card rounded-4 shadow border-0 px-4 py-4 mt-4">
          <div class="card-body pb-3">
          
              <div class="mb-3">
                  <p class="card-text fw-medium">Type de prestation : <?=$reservationBeforeNow['serviceType']?></p>
                  <p class="card-text fw-medium">Date de début : <?=date('d-m-Y', strtotime($reservationBeforeNow['startDate']))?></p>
                  <p class="card-text fw-medium">Date de fin : <?=date('d-m-Y', strtotime($reservationBeforeNow['endDate']))?></p>
                  <p class="card-text fw-bold">Prix total: <?=$reservationBeforeNow['totalPrice']?>€</p>
              </div>
                  
              <hr>

              <div class="d-flex align-items-center pt-2">
                  <div class="p-2">
                    <img src="data:image/jpeg;base64,<?= $reservationBeforeNow['petSitterImage']?>" class="rounded-image" alt="Avatar">
                  </div>
                  <div class="p-2 user-name ms-3">
                    <?= $reservationBeforeNow['FirstNameMaster']?>
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