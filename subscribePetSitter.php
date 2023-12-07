<?php

require 'templates/header-var.php';
require_once "Model/SizeRepository.php";
require_once "Model/AnimalTypesRepository.php";
require_once "Model/Database.php";
require_once "Model/Masters.php";
require_once "Model/config.php";
require_once "Model/MasterRepository.php";
require_once "Model/Pet.php";
require_once "Model/PetRepository.php";
require_once "Model/ServicesRepository.php";
require_once "Model/Services.php";
require_once "Model/AnimalTypes.php";
require_once "Model/ServicesCheck.php";
require_once "Model/PetSitters.php";
require_once "Model/PetSittersRepository.php";
require_once "Model/ResidenceTypesRepository.php";
require_once "Model/UserLogin.php";
require_once "Model/UsersLoginRepository.php";
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
  $image = "";
  if (!empty($_FILES["profilPicture"]["tmp_name"])) {
    $image = $_FILES["profilPicture"]["tmp_name"];
    $checkImage = $_FILES["profilPicture"]["error"];
  }
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

<div class="container-lg">
    <div class="row mt-5">

    <!-- Empty columns left -->    
    <div class="col-md-3"></div>

    <!-- Form -->
    <div class="col-md-6">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="bg-white shadow rounded-4 border-0 search-column py-4 px-5 mb-5">
          <div class="text-hero-bold text-center">
          Je veux devenir Pet Sitter
          </div>
          <div class="col-md-4 align-middle">
                <div class="text-hero-regular text-center text-md-start">Prestation :</div>
          </div>
              
              <div class="d-flex align-items-center mb-3 fw-bold pb-3">
                  <?php foreach ($services as $service) : ?>
                  <div class="p-2 flex-fill">
                    <input type="checkbox" autocomplete="off" class="radio" value="<?= $service->getId()?>" name="servicesTypeCheck[]" <?php if (!empty($_POST['servicesTypeCheck'])) { $servicesCheckCompare->checkBoxServices($service); }?>>
                    <label class="btn-checkbox me-4 border">
                      <?= $service->getServiceType()?>
                    </label>
                  </div>
              <?php endforeach ?>

            </div>
            <div class="cta d-grid gap-2 pt-3">
              <input type="submit" class="btn btn-primary" value="Je valide">
            </div>
            <?php if (!empty($_POST['servicesTypeCheck'])) { ?>
              <div class="d-flex justif-content-space-between">
                <input type="text" name="firstname" class="form-control me-2 pt3 pb3 mt-2" placeholder="Nom" aria-label=".form-control-lg example" required>
                <input type="text" name="lastname" class="form-control ms-2 mt-2" placeholder="Prénom" aria-label=".form-control-lg example" required>
              </div>
              <div>
                <input type="email" name="email" class="form-control mt-3 pt3 pb3" placeholder="Adresse email" aria-label=".form-control-lg example" required> 
              </div>
              <div class="d-flex justif-content-space-between">
                <input type="password" name="password" class="form-control me-2 pt3 pb3 mt-3" placeholder="Mot de passe" aria-label=".form-control-lg example" required>
                <input type="password" name="confirmpassword" class="form-control ms-2 mt-3" placeholder="Confirmer le mot de passe" aria-label=".form-control-lg example" required>
              </div>  
              <div>
                <input type="text" name="adresse" class="form-control mt-3 mb-3 pt3 pb3" placeholder="Adresse" aria-label=".form-control-lg example" required> 
              </div>
              <div class="d-flex justify-content-space-between">
                <input type="text" name="city" class="form-control me-2 pt3 pb3" placeholder="Ville" aria-label=".form-control-lg example" required>
                <input type="text" name="postalCode" class="form-control ms-2 pt3 pb3" placeholder="Code postal" aria-label=".form-control-lg example" required>
              </div>
              <div>
                <input type="phone" name="phoneNb" class="form-control mt-3 pt3 pb3" placeholder="N° de téléphone" aria-label=".form-control-lg example" required> 
              </div>
              <div class="d-flex justify-content-space-between pt-3">
                <div class="d-flex">
                  <label type="text" class="text-label-regular align-items-center mt-3 pe-3">Votre date de naissance :</label>
                </div>
              
              <input type="date" name="birthDate" class="shadow-sm pt3 pb3 mb-4 px-3 me-3 border rounded"  value="Date de naissance" required>
              </div>
              <div>
                <label for="attachFile" class="text-label-regular mb-3">Photo de profil :</label>
                <input type="file" name="profilPicture" placeholder = "Photo de Profil" required>
              </div>
              <div class="form-floating">
                <textarea name="description" class="form-control mt-3" placeholder="Décrivez votre expérience en tant que pet sitter" style="height: 100px" required></textarea>
                <label for="floatingTextarea2">Décrivez votre expérience en quelques lignes</label>
              </div>
              <div>
              <label for="text" class="text-label-regular mt-3">Avez-vous un animal ?</label>
                <select id="animalType" name = "animalType" class="form-select shadow-sm pt3 pb3 mt-3">
                    <option value="" class="text-muted">Sélectionnez un type</option>
                    <?php foreach ($animalTypes as $animalType) : ?>  
                      <option value="<?= $animalType->getId()?>"><?=$animalType->getAnimalType()?></option>
                    <?php endforeach ?>
                </select>
              </div>
              <fieldset class="d-flex flex-column align-items-start mt-3 w-75">
                    <p class="text-label-regular">Animaux acceptés :</p>
                        <?php foreach ($animalTypes as $animalType) :?>
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="<?= $animalType->getId()?>" id="flexCheckDefault" name="animalTypeAccept[]">
                              <label class="form-check-label" for="flexCheckDefault">
                              <?= $animalType->getAnimalType()?>
                              </label>
                          </div>
                        <?php endforeach ?>
                </fieldset>
                <fieldset class="d-flex flex-column align-items-start mt-3 w-75">
                    <p class="text-label-regular">Votre type de logement</p>
                        <?php foreach ($residenceTypes as $residenceType) :?>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" value="<?= $residenceType->getId()?>" id="flexCheckDefault" name="residenceType">
                              <label class="form-check-label" for="flexCheckDefault">
                                <?= $residenceType->getResidenceType()?>
                              </label>
                          </div>
                        <?php endforeach ?>
                </fieldset>
                <div class="mt-3">
                <p class="text-label-regular">Nombre d'années d'expérience en garde d'animaux :</p>
                <input type="number" name="nbExperience" placeholder = "0" class="form-control mt-3 pt3 pb3" required>
                </div>
                <?php $servicesCheckCompare->viewPricesServicesCheck($services, $service); ?>   
                  <div class="div row mb-3">
                    <div class="cta d-grid gap-2 pt-3">
                      <input type="submit" class="btn btn-primary" value="Je m'inscris !" name="addpetsitter" required>
                  </div>
              </div>
          <?php } ?>

      </form>
    </div>

    <!-- Empty columns right -->    
    <div class="col-md-3"></div>

    </div>

</div>