<?php
require_once 'Model/PetSitters.php';
require_once "Model/PetSittersRepository.php";
require_once "Model/Database.php";
require_once 'Model/ServicesRepository.php';


$id = 3;

$connectPetSitter = new PetsittersRepository();
$petsitter = $connectPetSitter-> getRow($id);

// $serviceId = $petsitter['service_id'];
// $connectService = new ServicesRepository();
// // $service = $connectService->getRow($serviceId);
// // var_dump($service);

// var_dump($petsitter);

// $petSitter = $query = "SELECT 
//         ps.*, pss.*, s.*, rt.*
//     FROM 
//         petSitters ps
//     LEFT JOIN 
//         petSitterServices pss ON ps.idpetSitter = pss.petSitter_id
//     LEFT JOIN 
//         services s ON pss.service_id = s.idservice
//     LEFT JOIN 
//         residenceTypes rt ON ps.residenceType_id = rt.idresidenceType
//     WHERE 
//         ps.idpetSitter = 3";
///--------------------------------------------------------

// var_dump($petsitter);

// exit();

$title = 'Profil du Pet Sitter';
?>



<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?=$title?></title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="emilia/styles.css">
    <title><?=$title?></title>
</head>
<body>
<!-- inclure le header avec la nav-bar -->


<div class="profil-container">

    <div class ='petsitter-contain flex align-start'>
        <div class ="flex flex-column align-start">
            <div class=" petsitter flex flex-row align-center">
                <img class="profil-img" src="<?=$petsitter['image']?>" alt="photo de profil du pet sitter" width="200px"></img>
                <div class="p-20">
                    <p class ="firstname"><?=$petsitter['firstName']?></p>
                    <p>Pet sitter à <?=$petsitter['sitterCity']?></p>
                    <button class ='btn btn-primary  btn-dark'>Contacter <?=$petsitter['firstName']?> </button>
                </div>
            </div>
            <ul>
                <li>Depuis <?=$petsitter['petSitterSince']?></li>
                <li><?=$petsitter['birthDate']?></li>
                <li>Type de logement : <?=$petsitter['serviceType']?></li>
                <li>Possède un animal : <?=$petsitter['type']?></li>
            </ul>
        </div>
        <div class ="service p-20">
            <h3>Services</h3>
            <p><?=$petsitter['serviceType']?></p>
            <p><span class='price'><?=$petsitter['price']?> € /jour</span></p>
            <p>Disponible <br>du <?=$petsitter['startDate']?> au <?=$petsitter['endDate']?></p>
        </div>
    </div>  
        <div>
            <?=$petsitter['description']?>
        </div>
    
</div>
<div class="gallery-container">
        <!-- La galerie sera affichée ici -->
</div>



































<!-- <footer class ="bg-black">
<nav class="nav-bottom" data-bs-theme="dark">
    <a href="mon-compte.php">Mon compte</a>
    <a href = "mes-reservations.php">Mes réservations</a>
    <a href ="contact.php">Contact</a>
</nav>
<p>© Margot - Mélanie - Emilia - 2023</p> -->


</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="js/gallery.js"></script>

</body>
</html>

