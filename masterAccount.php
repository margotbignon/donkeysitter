<?php
session_start();
if (empty($_SESSION['user'])) {
  header('Location:login.php');
}

require 'templates/header-var.php';
require_once "Model/SizeRepository.php";
require_once "Model/AnimalTypesRepository.php";
require_once "Model/Database.php";
require_once "Model/Masters.php";
require_once "Model/config.php";
require_once "Model/MasterRepository.php";
require_once "Model/Pet.php";
require_once "Model/PetRepository.php";
require_once "Model/AnimalTypes.php";
require_once "Model/UserLogin.php";
require_once "Model/UsersLoginRepository.php";
$idMaster = $_SESSION['user']['id'];
$sizeRepository = new SizeRepository();
$sizes = $sizeRepository -> getRows();
$animalTypesRepository = new AnimalTypesRepository();
$animalTypes = $animalTypesRepository -> getRows();
$masterRepository = new MasterRepository();
$master = $masterRepository->getRow($idMaster);
$userId = $master['iduser'];
$idPet = $master['idpet'];
if (!empty($_POST)) {
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password']) || empty($confirmPassword = $_POST['confirmpassword']) || empty($confirmPassword = $_POST['confirmpassword']) || empty($street = $_POST['adresse']) || empty($_POST['postalCode']) || empty($_POST['city']) || empty($_POST['phoneNb']) || empty($_POST['birthDate']) || empty($_POST['animalName']) || empty($_POST['race']) || empty($_POST['description']) || empty($_POST['yearBirth']) || empty($_POST['gender']) ||  empty($_POST['size'])) {
      $errorMessage = "Veuillez renseigner toutes les informations";
    } else {
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
        $animalName = $_POST['animalName'];
        $race = $_POST['race'];
        $description = $_POST['description'];
        $animalType = $_POST['animalType'];
        $yearBirth = $_POST['yearBirth'];
        $gender = $_POST['gender'];
        $size = $_POST['size'];
        $masterToUpdate = new Masters($firstname, $lastname, $phoneNb, $birthDate, $street, $postalCode, $city, $userId, $image);
        $masterUpdate = new MasterRepository();
        if (empty($_FILES["profilPicture"]["tmp_name"])) {
          $masterUpdate->updateRow($masterToUpdate, $idMaster);
        } else {
          $masterUpdate->updateRowWithImage($masterToUpdate, $idMaster, $checkImage);
        }
        $petToUpdate = new Pet($animalName, $description, $race, $gender, $yearBirth, $animalType, $size, $idMaster, $idPet);
        $petUpdate = new PetRepository();
        $petUpdate->updateRow($petToUpdate);
        header('Location:masterAccount.php');
  }
}
?>

<div class="container-lg">
    <div class="row mt-5">

    <!-- Empty columns left -->    
    <div class="col-md-3"></div>

    <!-- Form -->
    <div class="col-md-6">
      <form method="post" enctype="multipart/form-data">
            <?php if (!empty($errorMessage)):?>
                <div class="alert alert-danger" role="alert"><?=$errorMessage?></div>
             <?php endif;?>
        <div class="bg-white shadow rounded-4 border-0 search-column py-4 px-5 mb-5">
            <div class="p-2 text-center">
                <img src="data:image/jpeg;base64,<?= $master['image']?>" class="rounded-image-large" alt="Avatar">
            </div>
          <div class="text-hero-bold text-center">
          <?= $master['firstName']?> <?= $master['lastName']?> 
          </div>
          <div class="d-flex justif-content-space-between">
            <input type="text" name="firstname" class="form-control me-2 pt3 pb3" value="<?= $master['firstName']?>" aria-label=".form-control-lg example">
            <input type="text" name="lastname" class="form-control ms-2" value="<?= $master['lastName']?>" aria-label=".form-control-lg example">
          </div>
          <div>
          <label for="email" class="text-label-regular mb-3 mt-3">Email :</label>
            <input type="email" name="email" class="form-control pt3 pb3" value="<?= $master['email']?>" aria-label=".form-control-lg example"> 
          </div>
          <div class="d-flex justif-content-space-between">
            <input type="password" name="password" class="form-control me-2 pt3 pb3 mt-3" placeholder="Mot de passe" aria-label=".form-control-lg example">
            <input type="password" name="confirmpassword" class="form-control ms-2 mt-3" placeholder="Confirmer le mot de passe" aria-label=".form-control-lg example">
          </div>  
          <div>
          <label for="adresse" class="text-label-regular mb-3 mt-3">Adresse :</label>
            <input type="text" name="adresse" class="form-control mb-3 pt3 pb3" value="<?= $master['masterStreet']?>" aria-label=".form-control-lg example"> 
          </div>
          <div class="d-flex justify-content-space-between">
            <input type="text" name="city" class="form-control me-2 pt3 pb3" value="<?= $master['masterCity']?>" aria-label=".form-control-lg example">
            <input type="text" name="postalCode" class="form-control ms-2 pt3 pb3" value="<?= $master['masterPostalCode']?>" aria-label=".form-control-lg example">
          </div>
          <div>
          <label for="phoneNB" class="text-label-regular mb-3 mt-3">Numéro de téléphone :</label>
            <input type="phone" name="phoneNb" class="form-control pt3 pb3" value="<?= $master['phoneNb']?>" aria-label=".form-control-lg example"> 
          </div>
          <div class="d-flex justify-content-space-between pt-3">
            <div class="d-flex">
              <label type="text" class="text-label-regular align-items-center mt-3 pe-3" value>Votre date de naissance :</label>
            </div>
          
          <input type="date" name="birthDate" class="shadow-sm pt3 pb3 mb-4 px-3 me-3 border rounded"  value="<?= $master['birthDate']?>"/>
          </div>
          <div>
            <label for="attachFile" class="text-label-regular mb-3">Photo de profil :</label>
            <input type="file" name="profilPicture" placeholder = "Photo de Profil">
          </div>
          <div>
            <label for="animalName" class="text-label-regular mb-3 mt-3">Nom de votre animal :</label>
            <input type="text" name="animalName" class="form-control pt3 pb3" value="<?= $master['name']?>" aria-label=".form-control-lg example"> 
          </div>
          <div>
            <label for="race" class="text-label-regular mb-3 mt-3">Quelle est la race de votre animal ?</label>
            <input type="texte" name="race" class="form-control pt3 pb3" value="<?= $master['race']?>" aria-label=".form-control-lg example"> 
          </div>
          <label for="description" class="text-label-regular mb-3 mt-3">Décrivez le caractère de votre animal :</label>
          <div class="form-floating">
          
            <textarea name="description" class="form-control" style="height: 100px"><?= $master['description']?></textarea>
            
          </div>
          <div>
          <label for="animalType" class="text-label-regular mb-3 mt-3">Quel est le type de votre animal ?</label>
            <select id="animalType" name = "animalType" class="form-select shadow-sm pt3 pb3">
                <option value="" class="text-muted">Quel est le type de votre animal ?</option>
                <?php foreach ($animalTypes as $animalType) : ?>
                    <option value="<?= $animalType->getId()?>" <?php if ($animalType->getId() === $master['animalType_id']) {?>selected <?php } ?>><?=$animalType->getAnimalType()?></option>
                <?php endforeach ?>
            </select>
          </div>
          <div>
          <label for="yearBirth" class="text-label-regular mb-3 mt-3">Quelle est l'année de naissance de votre animal ?</label>
          <select id="yearBirth" name = "yearBirth" class="form-select shadow-sm pt3 pb3 mt-3">
              <option value="">Quelle est l'année de naissance de votre animal ?</option>
              <?php for($i= 2023 ; $i >2009 ; $i--) : ?>
                <option value="<?= $i ?>" <?php if ($i == $master['yearBirth']) { ?> selected <?php } ?>><?=$i?></option>
              <?php endfor ?>
            </select>
          </div>
          <div>
          <label for="gender" class="text-label-regular mb-3 mt-3">Quel est le genre de votre animal ?</label>
          <select id="gender" name = "gender" class="form-select shadow-sm pt3 pb3 mt-3">
              <option value="">Quel est le genre de votre animal ?</option>
              <option value="female" <?php if ($master['gender'] === 'female') { ?> selected <?php } ?>>Femelle</option>
              <option value="male" <?php if ($master['gender'] === 'male') { ?> selected <?php } ?>>Mâle</option>
            </select>
          </div>
          <div>
          <label for="size" class="text-label-regular mb-3 mt-3">Quelle est la taille de votre animal ?</label>
          <select id="size" name = "size" class="form-select shadow-sm pt3 pb3 mt-3">
              <option value="">Quelle est la taille de votre animal ?</option>
              <?php foreach ($sizes as $size) : ?>
                <option value="<?= $size['idsize']?>" <?php if ($size['idsize'] === $master['idsize']) {?>selected <?php } ?>><?= $size['size']?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="cta d-grid gap-2 pt-3">
            <input type="submit" class="btn btn-primary" value="Confirmer les modifications">
          </div>
        </div>
      </form>
    </div>

    <!-- Empty columns right -->    
    <div class="col-md-3"></div>

    </div>

</div>

<?php require_once "templates/footer.php"?>
