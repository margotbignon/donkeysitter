<?php
session_start();

require_once 'Templates/header.php';
require_once 'Model/Database.php';
require_once 'Model/ServicesRepository.php';
require_once 'Model/AvailabilityRepository.php';
require_once 'Model/AnimalTypesRepository.php';
require_once 'Model/PetSittersRepository.php';


$connectServices = new ServicesRepository();
$services = $connectServices->getRows();

$connectAnimalType = new AnimalTypesRepository();
$animalTypes = $connectAnimalType->getRows();

$connectPetSitters = new PetsittersRepository();
$countPetSitters = $connectPetSitters ->countFrom('petSitters');
// var_dump($countPetSitters);

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        isset($_POST['type']) && !empty($_POST['type']) &&
        isset($_POST['service']) && !empty($_POST['service']) &&
        isset($_POST['city']) && !empty($_POST['city']) &&
        isset($_POST['startDate']) && !empty($_POST['startDate']) &&
        isset($_POST['endDate']) && !empty($_POST['endDate'])
    ) {

        $startDate = new DateTime($_POST['startDate']);
        $endDate = new DateTime($_POST['endDate']);

        if ($endDate < $startDate) {
            $errorMessage = "La date de fin ne peut pas être antérieure à la date de début.";
        } else {
            $_SESSION['search'] = [
                'type' => $_POST['type'],
                'service' => $_POST['service'],
                'city' => $_POST['city'], 
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
            ];

            header('Location:sitters-list.php');
            exit();
        }

    } else {
        $errorMessage = "Veuillez remplir tous les champs pour lancer la recherche.";
    }
}

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
                        Faites votre recherche parmi nos <?=$countPetSitters?> pet sitters&nbsp;!
                    </div>


                    
                    <form class="form-home" action="" method="POST">
                    
                    <?php if (!empty($errorMessage)):?>
                        <div class="alert alert-danger" role="alert"><?=$errorMessage?></div>
                    <?php endif;?>
                    <label for="type" class="text-hero-regular text-center text-md-start">Je cherche un service pour</label>
                    <select class="form-select form-select-home shadow-sm pt-3 pb-3 border-0 mb-3" aria-label="Default select example" name="type" required>
                        <option value="" selected disabled hidden>Sélectionner</option>
                        <?php foreach ($animalTypes as $type): ?>
                            <option value="<?= $type->getId()?>"><?= $type->getAnimalType() ?></option>
                        <?php endforeach; ?>
                    </select>


                    <div class="col-md-8 form-postalcode">
                        <label for="pc-street" class="text-hero-regular text-center text-md-start">À proximité de</label>
                        <input class="form-control  pt-3 pb-3 mb-3" type="text" placeholder="Code postal ou ville" aria-label="default input example" name="city" required>
                    </div>

                    <label for="service" class="text-hero-regular text-center text-md-start">Prestation souhaitée</label>

                    <div class="col-md-8 display-none flex" data-toggle="buttons">
                        <?php foreach ($services as $service): ?>
                            <div class="flex space-between radio-container">
                                <input type="radio" autocomplete="off" name="service" value="<?= $service->getId() ?>" id="service-<?= $service->getId() ?>" class="radio" required />
                                <label class="radio-label" for="service-<?= $service->getId() ?>">
                                    <?= $service->getServiceType() ?>
                                </label>
                            </div>
                        <?php endforeach; ?>    
                    </div>

                    <div class="col-md-4 align-middle">
                        <label class="text-hero-regular text-center text-md-start">Pour les dates</label>
                    </div>

                    <div class="flex space-between">
                            <div>
                                <label for="startDate">du</label>
                                <input class="form-control form-date mb-3" type="date" id="start-date" name="startDate" required />
                            </div>

                            <div>
                            <label for ="endDate">au</label>
                            <input class="form-control form-date mb-3" type="date" id="end-date" name="endDate" required />
                            </div>
                    </div>

                    <div class="cta d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Trouver mon pet sitter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</section>

<?php
require_once 'Templates/footer.php';
?>
