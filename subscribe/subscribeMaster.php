<?php
require_once "../Model/SizeRepository.php";
require_once "../Model/AnimalTypesRepository.php";
require_once "../Model/Database.php";
require_once "../Model/config.php";
$sizeRepository = new SizeRepository();
$sizes = $sizeRepository -> getRows();
$animalTypesRepository = new AnimalTypesRepository();
$animalTypes = $animalTypesRepository -> getRows();
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
        <h1 class="text-center">Je veux confier mon animal <br>Inscription</h1>
        <form method="post" class="d-flex  flex-column align-items-center">
          <div class="d-flex mt-2 w-75">
            <input type="text" name="firstname" placeholder="Prénom" class="rounded border-0 p-2 w-50" >
            <input type="text" name="lastname" placeholder = "Nom" class="ms-2 rounded border-0 p-2 w-50">
          </div>
            <input type="email" name="email" placeholder = "Adresse E-mail" class="mt-3 w-75 rounded border-0 rounded border-0 p-2">
          <div class="d-flex w-75">
            <input type="password" name="password" placeholder = "Mot de passe" class="mt-3 rounded border-0 p-2 w-50">
            <input type="password" name="confirmpassword" placeholder ="Confirmer votre mot de passe" class="mt-3 rounded border-0 p-2 ms-2 w-50">
          </div>
            <input type="text" name="adresse" placeholder = "Adresse" class="mt-3 rounded border-0 p-2 w-75">
            <input type="phone" name="phoneNb" placeholder = "N° de téléphone" class="mt-3 rounded border-0 p-2 w-75">
            <div>Votre photo de profil
              <input type="file" name="profilPicture" placeholder = "Photo de Profil" class="mt-3">
            </div>
            <input type="text" name="animalName" placeholder = "Nom de votre animal" class="mt-3 rounded border-0 p-2 w-75">
            <input type="texte" name="race" placeholder = "Quelle est la race de votre animal ?" class="mt-3 rounded border-0 p-2 w-75">
            <select id="animalType" name = "animalType" class="mt-3 rounded border-0 p-2 w-75">
              <option value="" class="text-muted">Quel est le type de votre animal ?</option>
              <?php foreach ($animalTypes as $animalType) : ?>  
                <option value="<?= $animalType['idanimalType']?>"><?= $animalType['type']?></option>
              <?php endforeach ?>
            </select>
            <select id="yearBirth" name = "yearBirth" class="mt-3 rounded border-0 p-2 w-75">
              <option value="">Quelle est l'année de naissance de votre animal ?</option>  
              <option value="2023">2023</option>
              <option value="2022">2022</option>
              <option value="2021">2021</option>
              <option value="2020">2020</option>
              <option value="2019">2019</option>
              <option value="2018">2018</option>
              <option value="2017">2017</option>
              <option value="2016">2016</option>
              <option value="2015">2015</option>
              <option value="2014">2014</option>
              <option value="2013">2013</option>
              <option value="2012">2012</option>
              <option value="2011">2011</option>
              <option value="2010">2010</option>
            </select>

            <select id="gender" name = "gender" class="mt-3 rounded border-0 p-2 w-75">
              <option value="" placeholder="Quel est le genre de votre animal ?">Quel est le genre de votre animal ?</option>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>    
  </body>
</html>