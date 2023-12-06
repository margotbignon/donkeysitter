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
require_once "../Model/AnimalTypes.php";
require_once "../Model/UserLogin.php";
require_once "../Model/UsersLoginRepository.php";
$sizeRepository = new SizeRepository();
$sizes = $sizeRepository -> getRows();
$animalTypesRepository = new AnimalTypesRepository();
$animalTypes = $animalTypesRepository -> getRows();
if (!empty($_POST)) {
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
  $animalName = $_POST['animalName'];
  $race = $_POST['race'];
  $description = $_POST['description'];
  $animalType = $_POST['animalType'];
  $yearBirth = $_POST['yearBirth'];
  $gender = $_POST['gender'];
  $size = $_POST['size'];
  $userLogin = new UserLogin($email, $password, 'master');
  $insertUserLogin = new UsersLoginRepository();
  $userId = $insertUserLogin->insertRow($userLogin, $confirmPassword);
  $master = new Masters($firstname, $lastname, $phoneNb, $birthDate, $street, $postalCode, $city, $userId, $image);
  $insertRowMasters = new MasterRepository();
  if (!empty($_FILES['profilPicture']['name'])) {
    $lastInsertId = $insertRowMasters->insertRowWithImage($master, $checkImage,$ageDifference);
  } else {
    $lastInsertId = $insertRowMasters->insertRow($master, $ageDifference);
  }
  /*
  $pet = new Pet($animalName, $description, $race, $gender, $yearBirth, $animalType, $size, $lastInsertId);
  $insertRowMasters = new PetRepository();
  $insertRowMasters->insertRow($pet);*/
}
?>
    <section class="container mt-5 bg-transparent suscribeform rounded w-50">
        <h1 class="text-center">Je veux confier mon animal <br>Inscription</h1>
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
            <div class="text-left">
              Votre date de naissance
              <input type="date" name="birthDate" class="mt-3 rounded border-0 p-2 ">
            </div>
            <div>Votre photo de profil
              <input type="file" name="profilPicture" placeholder = "Photo de Profil" class="mt-3">
            </div>
            <input type="text" name="animalName" placeholder = "Nom de votre animal" class="mt-3 rounded border-0 p-2 w-75">
            <input type="texte" name="race" placeholder = "Quelle est la race de votre animal ?" class="mt-3 rounded border-0 p-2 w-75">
            <textarea name="description" placeholder = "Décrivez votre animal" class="mt-3 rounded border-0 p-2 w-75"></textarea>
            <select id="animalType" name = "animalType" class="mt-3 rounded border-0 p-2 w-75">
              <option value="" class="text-muted">Quel est le type de votre animal ?</option>
              <?php foreach ($animalTypes as $animalType) : ?>  
                <option value="<?= $animalType->getId()?>"><?=$animalType->getAnimalType()?></option>
              <?php endforeach ?>
            </select>
            <select id="yearBirth" name = "yearBirth" class="mt-3 rounded border-0 p-2 w-75">
              <option value="">Quelle est l'année de naissance de votre animal ?</option>
              <?php for($i= 2023 ; $i >2009 ; $i--) : ?>
                <option value="<?= $i ?>"><?=$i?></option>
              <?php endfor ?>
            </select>

            <select id="gender" name = "gender" class="mt-3 rounded border-0 p-2 w-75">
              <option value="">Quel est le genre de votre animal ?</option>
              <option value="female">Femelle</option>
              <option value="male">Mâle</option>
            </select>
            <select id="size" name = "size" class="mt-3 rounded border-0 p-2 w-75">
              <option value="">Quelle est la taille de votre animal ?</option>
              <?php foreach ($sizes as $size) : ?>
                <option value="<?= $size['idsize']?>"><?= $size['size']?></option>
              <?php endforeach ?>
            </select>
            <input type="submit" class="btn btn-warning bg-danger mt-3 text-white w-25" value="Je m'inscris !">



        </form>
  </section>
  <?php include "../Templates/footer.php";?>