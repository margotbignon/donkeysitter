<?php
session_start();
require_once "Model/Database.php";
include 'Templates/header-var.php';
require_once 'Model/PetSitters.php';
require 'Model/PetSittersRepository.php';
require_once 'Model/ServicesRepository.php';
require_once 'Model/AnimalTypesRepository.php';

$title = 'Pet Sitters';

$connectServices = new ServicesRepository();
$services = $connectServices->getRows();

$connectAnimalType = new AnimalTypesRepository();
$animalTypes = $connectAnimalType->getRows();

if (!isset($_SESSION['search']) || empty($_SESSION['search'])) {
    $errorMessage = 'Aucune requête effectuée.';
    // Peut-être rediriger l'utilisateur vers une page de recherche ou afficher un message approprié.
} else {
    $search = $_SESSION['search'];

    $animalType = $search['type'];
    $serviceId = $search['service'];
    $city = $search['city'];
    $startDate = $search['startDate'];
    $endDate = $search['endDate'];

    // var_dump($_SESSION['search']);
}

$connPetSittersRepo = new PetSittersRepository();
$petsitters = $connPetSittersRepo->getRowsByPost($startDate, $endDate, $city, $serviceId);
// var_dump($petsitters);
if (!empty($errorMessage)) {
    echo `$errorMessage`;
}


if (empty($petsitter)) {
    $petsitters = $connPetSittersRepo->getRowsByCity($city);
    $count = count($petsitters);
    $result =  "Nous avons trouvé ".$count . " pet sitter(s) dans la ville de votre choix.";
    

}
    else {
        $result =  "Aucun pet sitter ne correspond à votre recherche.";
        $petsitters = $connPetSittersRepo->getAllRows();
    }



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

            // Générer le lien vers la page avec les paramètres mis à jour
            $redirectLink = 'listPetSitter.php?';
            $redirectLink .= http_build_query($_SESSION['search']);

            // Utiliser JavaScript pour rediriger
            echo "<script>window.location.href = '$redirectLink';</script>";
            exit();
        }
    } else {
        $errorMessage = "Veuillez remplir tous les champs pour lancer la recherche.";
    }
}

$avail = "dès aujourd'hui !";


?>

<div class="container-lg">
<?php if (isset($result)) echo "<p class ='m-3'>$result</p>" ?>
    <div class="row my-5">
        <!-- Column filters -->
        <div class="col-md-4">
            <div class="bg-white shadow rounded-4 border-0 search-column py-4 px-4">
                <h4 class="pb-4">Ma recherche</h4>
                <form class="form-control" action="" method="POST">
                    <label for="animalType" class="text-label-regular mb-3">Type d'animal :</label>
                    <select id="animalType" name ="type" class="form-select shadow-sm pt3 pb3 mb-4" aria-label="Default select example">
                        <option value="" selected disabled hidden>Sélectionner</option>
                        <?php foreach ($animalTypes as $type): ?>
                            <option value="<?= $type->getId()?>"><?= $type->getAnimalType() ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="city" class="text-label-regular mb-3">A proximité de :</label>
                    <input id="city" class="form-control pt3 pb3 mb-4" type="text" placeholder="Code postal ou ville" aria-label="default input example" name="city">

                    <label for="service" class="text-label-regular mb-3">Prestation :</label>
                    <div class="mb-3">
                        <div class="col-md-8 display-none flex wrap" data-toggle="buttons">
                            <?php foreach ($services as $service): ?>
                                <div class="radio-container">
                                    <input type="radio" autocomplete="off" name="service" value="<?= $service->getId() ?>" id="service-<?= $service->getId() ?>" class="radio " required />
                                    <label class="mb-3 radio-label radio-label-list border text-center" for="service-<?= $service->getId() ?>">
                                        <?= $service->getServiceType() ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>    
                        </div>
                    </div>
                    <div>
                        <label for="dates" class="text-label-regular mb-3">Dates :</label>
                        <div class="d-flex flex-row mb-3">
                            <div class="p-2">
                                <input class="shadow-sm pt3 pb3 mb-4 px-3 me-3 border rounded" type="date" id="startDate" name="startDate" value="Date de début"/>
                            </div>
                            <div class="p-2 fw-bold text-end">
                                <input class="shadow-sm pt3 pb3 mb-4 px-3 border rounded" type="date" id="end" name="endDate" value="Date de fin"/>
                            </div>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary w-100" value="Trouver mon pet sitter !">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Conteneur de droite -->
       

        <div class="col-md-8">
    <div class="row">
        <?php foreach ($petsitters as $petsitter) : ?>
            <!-- Première Card -->
            <div class="col-md-4">
                <div class="card rounded-4 mb-3 shadow border-0">
                    <img src="<?= $petsitter['image'] ?>" class="card-img-top" alt="photo de profil de <?= $petsitter['firstName'] ?>">
                    <div class="card-body pb-4">
                        <h5 class="card-title"><?= $petsitter['firstName'] ?></h5>
                        <p class="card-text fw-medium"><?= $petsitter['sitterPostalCode'] ?> - <?= $petsitter['sitterCity'] ?></p>
                        <p class="card-text fw-medium"><i class='bx bx-home-heart'></i>Habite en <?= $petsitter['residenceType'] ?></p>
                        
                        <?php
                        if (!empty($petsitter['startDate'])) {
                            $startDate = new DateTime($petsitter['startDate']);
                            $avail = "dès aujourd'hui.";

                            if ($startDate <= new DateTime()) {
                                $starDate = "dès le " . $startDate->format('Y-m-d');
                            } else {
                                $starDate = $avail;
                            }
                        } else {
                            $starDate = $avail;
                        }
                        ?>


                        <p>Disponible <?= $starDate ?></p>

                        <p class="card-text mb-4"></p>
                        <div class="fw-bold pb-4"><?= $petsitter['price'] ?>€/jour</div>
                        <div class="fw-bold">
                            <a href="profil-sitter.php?id=<?= $petsitter['idpetSitter'] ?>" class="btn-small btn-primary">Voir le profil</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

        
        

    </div>
</div>
<?php include 'Templates/footer.php';?>
