<?php

require 'templates/header-var.php';

?>

<div class="container-lg ">
  <h2 class="mb-5 pt-5">Mes réservations</h2>

    <div class="row">
    <!-- Réservation à venir -->
    <h5>A venir</h5>
    <!-- Card conteneur -->
      <div class="col-md-4">
        <div class="card rounded-4 shadow border-0 px-4 py-4 mt-4">
        <div class="card-body pb-3">
                
            <div class="d-flex align-items-center mb-3 fw-bold">
              <div class="circle p-2 me-2"></div>
              <div class="p-2">
              Statut: en attente de validation 
              </div>
            </div>

            <div class="mb-3">
              <p class="card-text fw-medium">Type de prestation : hébergement</p>
              <p class="card-text fw-medium">Date de début : hébergement</p>
              <p class="card-text fw-medium">Date de fin : hébergement</p>
              <p class="card-text fw-bold">Prix total: 22€</p>
            </div>
                
            <hr>

            <div class="d-flex align-items-center pt-2">
              <div class="p-2">
                <img src="../Assets/user1.jpg" class="rounded-image" alt="Avatar">
              </div>
              <div class="p-2 user-name ms-3">
                Dalla
              </div>
              <div class="p-2 ms-auto">
                <input type="submit" class="btn-small btn-primary" value="Voir le profil">
              </div>
            </div>
        </div>
       </div>
      </div>
    </div>

<div class="row py-5">

    <!-- Réservation à venir -->
    <h5>Passées</h5>
    <!-- Card conteneur -->
    <div class="col-md-4">
        <div class="card rounded-4 shadow border-0 px-4 py-4 mt-4">
        <div class="card-body pb-3">
         
            <div class="mb-3">
                <p class="card-text fw-medium">Type de prestation : hébergement</p>
                <p class="card-text fw-medium">Date de début : hébergement</p>
                <p class="card-text fw-medium">Date de fin : hébergement</p>
                <p class="card-text fw-bold">Prix total: 22€</p>
            </div>
                
            <hr>

            <div class="d-flex align-items-center pt-2">
                <div class="p-2">
                  <img src="../Assets/user1.jpg" class="rounded-image" alt="Avatar">
                </div>
                <div class="p-2 user-name ms-3">
                    Dalla
                </div>
                <div class="p-2 ms-auto">
                    <input type="submit" class="btn-small btn-primary" value="Voir le profil">
                </div>
            </div>
      </div>
    </div>
    </div>
</div>
</div>