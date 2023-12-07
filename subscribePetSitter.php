<?php
include "../Templates/header.php";
require_once "../Model/SizeRepository.php";
require_once "../Model/AnimalTypesRepository.php";
require_once "../Model/Database.php";
require_once "../Model/Masters.php";
require_once "../Model/config.php";
require_once "../Model/MasterRepository.php";
require_once "../Model/Pet.php";
require_once "../Model/PetRepository.php";
require_once "../Model/ServicesRepository.php";
require_once "../Model/Services.php";
require_once "../Model/AnimalTypes.php";
require_once "../Model/ServicesCheck.php";
require_once "../Model/PetSitters.php";
require_once "../Model/PetSittersRepository.php";
require_once "../Model/ResidenceTypesRepository.php";
require_once "../Model/UserLogin.php";
require_once "../Model/UsersLoginRepository.php";
$sizeRepository = new SizeRepository();
$sizes = $sizeRepository -> getRows();
$animalTypesRepository = new AnimalTypesRepository();
$animalTypes = $animalTypesRepository -> getRows();
$servicesRepository = new ServicesRepository();
$services = $servicesRepository->getRows();
$residenceTypesRepository = new ResidenceTypesRepository();
$residenceTypes = $residenceTypesRepository->getRows();
if (!empty($_POST['servicesTypeCheck'])) {
  $servicesCheck = $_POST['servicesTypeCheck']; 
  $servicesCheckCompare = new ServicesCheck($servicesCheck);
}
if (!empty($_POST['addpetsitter'])) {

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmpassword'];
  $street = $_POST['adresse'];
  $postalCode = $_POST['postalCode'];
  $city = $_POST['city'];
  $phoneNb = $_POST['phoneNb'];
  $birthDate = $_POST['birthDate'];
  $birthDateDateTime = new DateTime($birthDate); 
  $currentDate = new DateTime();
  $ageDifference = $currentDate->diff($birthDateDateTime);
  $image = $_FILES["profilPicture"]["tmp_name"];
  $checkImage = $_FILES["profilPicture"]["error"];
  $description = $_POST['description'];
  $animalType = $_POST['animalType'];
  $nbExperience = $_POST['nbExperience'];
  $price = $_POST['price'];
  $residenceType = "";
  if (!empty($_POST['residenceType'])) {
    $residenceType = $_POST['residenceType'];
  }
  $userLogin = new UserLogin($email, $password, 'petSitter');
  $insertUserLogin = new UsersLoginRepository();
  $userId = $insertUserLogin->insertRow($userLogin, $confirmPassword);
  $petSitter = new PetSitters($firstname, $lastname, $phoneNb, $birthDate, $street, $postalCode, $city, $userId, $description, $nbExperience, $residenceType, $animalType, $image);
  $petSitterRepository = new PetsittersRepository();
  $lastInsertId = $petSitterRepository->insertRow($petSitter, $checkImage, $ageDifference);
  $petSitterServicesInsert = new PetsittersRepository();
  foreach ($price as $id => $value) {
    $petSitterServicesInsert->insertPetSitterServices($id, $lastInsertId, $value);
  }
  $petSitterAnimalAccept = new PetsittersRepository();
  $animalTypesAccept = "";
  if (!empty($_POST['animalTypeAccept'])) {
    $animalTypesAccept = $_POST['animalTypeAccept'];
    foreach ($animalTypesAccept as $animalTypeAccept) {
      $petSitterAnimalAccept->insertPetSitterAnimalsAccept($animalTypeAccept, $lastInsertId);
    } 
  }

  
} 
?>
<!DOCTYPE html>
    <section class="container mt-5 bg-transparent suscribeform rounded w-50">
        <h1 class="text-center">Je veux garder des animaux <br>Inscription</h1>
        <form method="post" class="d-flex  flex-column align-items-center" enctype="multipart/form-data">
        <fieldset class="d-flex flex-column align-items-start mt-3 w-75">
                <p>Type de service proposé</p>
                <?php foreach ($services as $service) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value = "<?= $service->getId()?>" name="servicesTypeCheck[]" <?php if (!empty($_POST['servicesTypeCheck'])) { $servicesCheckCompare->checkBoxServices($service); }?> >
                        <label class="form-check-label" for="flexCheckDefault">
                            <?= $service->getServiceType()?>
                        </label>
                    </div>
                <?php endforeach ?>
        </fieldset>
            <input type="submit" class="btn btn-warning bg-danger mt-3 text-white w-25" value="Valider">
            <?php if (!empty($_POST['servicesTypeCheck'])) { ?>
              <div class="d-flex mt-2 w-75">
            <input type="text" name="firstname" placeholder="Prénom" class="rounded border-0 p-2 w-50" required>
            <input type="text" name="lastname" placeholder = "Nom" class="ms-2 rounded border-0 p-2 w-50" required>
          </div>
            <input type="email" name="email" placeholder = "Adresse E-mail" class="mt-3 w-75 rounded border-0 rounded border-0 p-2" required>
          <div class="d-flex w-75">
            <input type="password" name="password" placeholder = "Mot de passe" class="mt-3 rounded border-0 p-2 w-50" required>
            <input type="password" name="confirmpassword" placeholder ="Confirmez votre mot de passe" class="mt-3 rounded border-0 p-2 ms-2 w-50" required>
          </div>
            <input type="text" name="adresse" placeholder = "Adresse" class="mt-3 rounded border-0 p-2 w-75" required>
            <div class="d-flex mt-2 w-75">
            <input type="text" name="postalCode" placeholder="Code Postal" class="rounded border-0 p-2 w-50" required>
            <input type="text" name="city" placeholder = "Ville" class="ms-2 rounded border-0 p-2 w-50" required>
          </div>
          
            <input type="phone" name="phoneNb" placeholder = "N° de téléphone" class="mt-3 rounded border-0 p-2 w-75" required>
            <div class="d-flex flex justify-content-start w-75">
                <p class="mt-4">Votre date de naissance</p>
              <input type="date" name="birthDate" class="mt-3 rounded border-0 p-2 ms-2 w-50" required>
            </div>
            <div>Votre photo de profil
              <input type="file" name="profilPicture" placeholder = "Photo de Profil" class="mt-3" required>
            </div>
            <textarea name="description" placeholder = "Parlez-nous de votre expérience en garde d'animaux" class="mt-3 rounded border-0 p-2 w-75" required></textarea>
            <fieldset class="d-flex flex-column align-items-start mt-3 w-75" required>
                <p>Votre type de logement</p>
                <?php foreach ($residenceTypes as $residenceType) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value = "<?= $residenceType->getId()?>" name="residenceType">
                        <label class="form-check-label" for="flexCheckDefault">
                            <?= $residenceType->getResidenceType()?>
                        </label>
                    </div>
                <?php endforeach ?>
        </fieldset>
            <div class="d-flex flex justify-content-start w-75">
                <p class="mt-4">Avez-vous un animal ? </p>
                <select id="animalType" name = "animalType" class="mt-3 rounded border-0 p-2 w-50 ms-2">
                <option value="" class="text-muted">Sélectionnez son type</option>
                <?php foreach ($animalTypes as $animalType) : ?>  
                    <option value="<?= $animalType->getId()?>"><?=$animalType->getAnimalType()?></option>
                <?php endforeach ?>
                </select>
            </div>
            <fieldset class="d-flex flex-column align-items-start mt-3 w-75" required>
                <p>Animaux acceptés</p>
                <?php foreach ($animalTypes as $animalType) :?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $animalType->getId()?>" id="flexCheckDefault" name="animalTypeAccept[]">
                        <label class="form-check-label" for="flexCheckDefault">
                        <?= $animalType->getAnimalType()?>
                        </label>
                    </div>
                <?php endforeach ?>
            </fieldset>
            <input type="number" name="nbExperience" placeholder = "Nombre d'années d'expérience en garde d'animaux" class="mt-3 rounded border-0 p-2 w-75" required>
            <?php $servicesCheckCompare->viewPricesServicesCheck($services, $service); ?>    

            <input type="submit" class="btn btn-warning bg-danger mt-3 text-white w-25" value="Je m'inscris !" name="addpetsitter">

 <?php } ?>




        </form>
  </section>
  <?php include "../Templates/footer.php";?>