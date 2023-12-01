<?php

require 'templates/header.php';


?>


<!-- hero section -->

<section class="hero">
    <div class="container-lg mt-4 mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="text-hero-bold text-center text-md-start">
                    Des services de pet sitting à proximité. Réservez des pet sitters de confiance !
                    </div>
                    <div class="text-hero-regular text-center text-md-start fw-bold ">
                        Faites votre recherche parmi nos 5449 pet sitters :
                    </div>
                    
                    <div class="row mb-4">
                        <!-- Première Sous-Colonne de 2 Colonnes -->
                        <div class="col-md-4">
                        <!-- Contenu de la Première Sous-Colonne -->
                        <div class="text-hero-regular text-center text-md-start">Type d'animal:</div>
                        </div>
                        <!-- Deuxième Sous-Colonne de 4 Colonnes -->
                        <div class="col-md-8">
                        <!-- Contenu de la Deuxième Sous-Colonne -->
                        <select class="form-select shadow-sm pt3 pb3 border-0" aria-label="Default select example">
                            <option selected>Sélectionner</option>
                            <option value="1">Chien</option>
                            <option value="2">Chat</option>
                            <option value="3">Oiseau</option>
                        </select>
                        </div>
                    </div>
                    <div class="div row mb-4">
                        <div class="col-md-4 align-middle">
                            <div class="text-hero-regular text-center text-md-start">Prestation :</div>
                        </div>
                        <div class="col-md-8 align-middle btn-group" data-toggle="buttons">
                            <label class="btn-checkbox me-4">
                                <input type="checkbox" autocomplete="off">Hébergement
                            </label>
                            <label class="btn-checkbox">
                                <input type="checkbox" autocomplete="off">Garde à domicile
                            </label>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <!-- Première Sous-Colonne de 2 Colonnes -->
                        <div class="col-md-4 align-middle">
                        <!-- Contenu de la Première Sous-Colonne -->
                            <div class="text-hero-regular text-center text-md-start">A proximité de :</div>
                        </div>
                        <!-- Deuxième Sous-Colonne de 4 Colonnes -->
                        <div class="col-md-8">
                            <!-- Contenu de la Deuxième Sous-Colonne -->
                        <input class="form-control pt3 pb3" type="text" placeholder="Code postal ou ville" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <!-- Première Sous-Colonne de 2 Colonnes -->
                        <div class="col-md-4 align-middle">
                        <!-- Contenu de la Première Sous-Colonne -->
                            <div class="text-hero-regular text-center text-md-start">Dates :</div>
                        </div>
                        <!-- Deuxième Sous-Colonne de 4 Colonnes -->
                        <div class="col-md-4">
                            <!-- Contenu de la Deuxième Sous-Colonne -->
                        <input type="date" id="start" name="trip-start" value="Date de début" />
                        </div>
                        <div class="col-md-4">
                            <!-- Contenu de la Deuxième Sous-Colonne -->
                        <input type="date" id="start" name="trip-start" value="Date de début" />
                        </div>
                    </div>
                    <div class="cta d-grid gap-2">
                        <a href="#" class="btn btn-primary">
                            Trouver mon pet sitter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>