<?php
require 'templates/header-var.php';
?>

<div class="container-lg">
    <div class="row my-5">

        <!-- Column filters -->
        <div class="col-md-4">
            <div class="bg-white shadow rounded-4 border-0 search-column py-4 px-4">
                <h4 class="pb-4">Ma recherche</h4>
                <form action="" method="get">
                    <label for="firstName" class="text-label-regular mb-3">Type d'animal :</label>
                    <select id="firstName" class="form-select shadow-sm pt3 pb3 mb-4" aria-label="Default select example">
                        <option selected>Sélectionner</option>
                        <option value="1">Chien</option>
                        <option value="2">Chat</option>
                        <option value="3">Oiseau</option>
                    </select>

                    <label for="location" class="text-label-regular mb-3">A proximité de :</label>
                    <input id="location" class="form-control pt3 pb3 mb-4" type="text" placeholder="Code postal ou ville" aria-label="default input example">

                    <label for="service" class="text-label-regular mb-3">Prestation :</label>
                    <div class="d-flex flex-row mb-3">
                        <div class="p-2 fw-bold text-center me-2">
                            <label class="btn-checkbox me-4 border">
                                <input id="service1" type="checkbox" autocomplete="off">
                                <p>Hébergement</p>
                            </label>
                        </div>
                        <div class="p-2 fw-bold text-center">
                            <label class="btn-checkbox me-4 border ">
                                <input id="service2" type="checkbox" autocomplete="off">
                                <p>Garde à domicile</p>
                            </label>
                        </div>
                    </div>

                    <label for="dates" class="text-label-regular mb-3">Dates :</label>
                    <div class="d-flex flex-row mb-3">
                        <div class="p-2">
                            <input class="shadow-sm pt3 pb3 mb-4 px-3 me-3 border rounded" type="date" id="start" name="service-start" value="Date de début"/>
                        </div>
                        <div class="p-2 fw-bold text-end">
                            <input class="shadow-sm pt3 pb3 mb-4 px-3 border rounded" type="date" id="end" name="service-end" value="Date de fin"/>
                        </div>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary w-100" value="Trouver mon pet sitter !">
                    </div>
                </form>
            </div>
        </div>

        <!-- Conteneur de droite -->
        <div class="col-md-8">
            <div class="row">

                <!-- Première Card -->
                <div class="col-md-4">
                    <div class="card rounded-4 mb-3 shadow border-0">
                        <img src="../Assets/user3.jpg" class="card-img-top" alt="...">
                        <div class="card-body pb-4">
                            <h5 class="card-title">Dalla</h5>
                            <p class="card-text fw-medium">Paris 75020</p>
                            <p class="card-text fw-medium"><i class='bx bx-home-heart'></i> Maison</p>
                            <p class="card-text mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.
                            </p>
                            <div class="fw-bold pb-4">22€/jour</div>
                            <div class="fw-bold">
                                <input type="submit" class="btn-small btn-primary" value="Voir le profil">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
