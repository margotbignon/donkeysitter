<?php
require_once "../Model/SizeRepository.php";
require_once "../Model/AnimalTypesRepository.php";
require_once "../Model/Database.php";
require_once "../Model/Masters.php";
require_once "../Model/config.php";
require_once "../Model/MasterRepository.php";
require_once "../Model/Pet.php";
require_once "../Model/PetRepository.php";
require_once "../Model/ServicesRepository.php";
$sizeRepository = new SizeRepository();
$sizes = $sizeRepository -> getRows();
$animalTypesRepository = new AnimalTypesRepository();
$animalTypes = $animalTypesRepository -> getRows();
$servicesRepository = new ServicesRepository();
$services = $servicesRepository->getRows();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hello!</title>
    <meta name="description" content="description"/>
    <meta name="author" content="author" />
    <meta name="keywords" content="keywords" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style type="text/css">.body { width: auto; }</style>
  </head>
  <body class="bg-warning" style="font-family:'Montserrat', sans-serif">
    <section class="container mt-5 bg-transparent suscribeform rounded w-50">
        <h1 class="text-center">Je veux garder des animaux <br>Inscription</h1>
        <form method="post" class="d-flex  flex-column align-items-center" enctype="multipart/form-data">
          <div class="d-flex mt-2 w-75">
            <input type="text" name="firstname" placeholder="Prénom" class="rounded border-0 p-2 w-50">
            <input type="text" name="lastname" placeholder = "Nom" class="ms-2 rounded border-0 p-2 w-50">
          </div>
            <input type="email" name="email" placeholder = "Adresse E-mail" class="mt-3 w-75 rounded border-0 rounded border-0 p-2">
          <div class="d-flex w-75">
            <input type="password" name="password" placeholder = "Mot de passe" class="mt-3 rounded border-0 p-2 w-50">
            <input type="password" name="confirmpassword" placeholder ="Confirmez votre mot de passe" class="mt-3 rounded border-0 p-2 ms-2 w-50">
          </div>
            <input type="text" name="adresse" placeholder = "Adresse" class="mt-3 rounded border-0 p-2 w-75">
            <div class="d-flex mt-2 w-75">
            <input type="text" name="postalCode" placeholder="Code Postal" class="rounded border-0 p-2 w-50" >
            <input type="text" name="city" placeholder = "Ville" class="ms-2 rounded border-0 p-2 w-50">
          </div>
          
            <input type="phone" name="phoneNb" placeholder = "N° de téléphone" class="mt-3 rounded border-0 p-2 w-75">
            <div class="d-flex flex justify-content-start w-75">
                <p class="mt-4">Votre date de naissance</p>
              <input type="date" name="birthDate" class="mt-3 rounded border-0 p-2 ms-2 w-50">
            </div>
            <div>Votre photo de profil
              <input type="file" name="profilPicture" placeholder = "Photo de Profil" class="mt-3">
            </div>
            <textarea name="description" placeholder = "Parlez-nous de votre expérience en garde d'animaux" class="mt-3 rounded border-0 p-2 w-75"></textarea>
            <div class="d-flex flex justify-content-start w-75">
                <p class="mt-4">Avez-vous un animal ? </p>
                <select id="animalType" name = "animalType" class="mt-3 rounded border-0 p-2 w-50 ms-2">
                <option value="" class="text-muted">Sélectionnez son type</option>
                <?php foreach ($animalTypes as $animalType) : ?>  
                    <option value="<?= $animalType['idanimalType']?>"><?= $animalType['type']?></option>
                <?php endforeach ?>
                </select>
            </div>
            <fieldset class="d-flex flex-column align-items-start mt-3 w-75">
                <p>Animaux acceptés</p>
                <?php foreach ($animalTypes as $animalType) :?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $animalType['idanimalType']?>" id="flexCheckDefault" name="animalTypeAccept[]">
                        <label class="form-check-label" for="flexCheckDefault">
                        <?= $animalType['type']?>
                        </label>
                    </div>
                <?php endforeach ?>
            </fieldset>
            <input type="number" name="nbExperience" placeholder = "Nombre d'années d'expérience en garde d'animaux" class="mt-3 rounded border-0 p-2 w-75">
            <input type="number" name="animalMax" placeholder = "Nombre d'animaux maximum acceptés" class="mt-3 rounded border-0 p-2 w-75" min="1">
            <fieldset class="d-flex flex-column align-items-start mt-3 w-75">
                <p>Type de service proposé</p>
                <?php foreach ($services as $service) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value = "<?= $service['idservice']?>" typename="servicesType[]">
                        <label class="form-check-label" for="flexCheckDefault">
                            <?= $service['serviceType']?>
                        </label>
                    </div>
                <?php endforeach ?>
            </fieldset>       
                    
            <input type="submit" class="btn btn-warning bg-danger mt-3 text-white w-25" value="Je m'inscris !">



        </form>
  </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>    
  </body>
</html>