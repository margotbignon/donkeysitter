<?php
require_once 'Templates/header.php';
require_once 'Model/Database.php';
require_once 'Model/ServicesRepository.php';
require_once 'Model/AvailabilityRepository.php';
require_once 'Model/AnimalTypesRepository.php';

$connectServices = new ServicesRepository();
$services = $connectServices->getRows();

$connectAnimalType = new AnimalTypesRepository();
$animalTypes = $connectAnimalType->getRows();
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
                    <div class="text-hero-regular text-center text-md-start fw-bold">
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
                            <select class="form-select shadow-sm pt-3 pb-3 border-0" aria-label="Default select example">
                                <option selected>Sélectionner</option>
                                <?php foreach ($animalTypes as $type): ?>
                                    <option value="<?= $type['type'] ?>"><?= $type['type'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <!-- Première Sous-Colonne de 2 Colonnes -->
                        <div class="col-md-4 align-middle">
                            <div class="text-hero-regular text-center text-md-start">Prestation :</div>
                        </div>
                        <!-- Deuxième Sous-Colonne de 4 Colonnes -->
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
                            <input class="form-control pt-3 pb-3" type="text" placeholder="Code postal ou ville"
                                aria-label="default input example">
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
                            <input type="date" id="end" name="trip-end" value="Date de fin" />
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

<?php
require_once 'Templates/footer.php';
?>
