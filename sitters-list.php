<?php
session_start();
require_once "Model/Database.php";
require_once 'Model/PetSitters.php';
require 'Model/PetSittersRepository.php';
include 'Templates/header-var.php';
$title = 'Pet Sitters';

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

  var_dump($_SESSION['search']);
}


$connPetSittersRepo = new PetSittersRepository();
$petsitters = $connPetSittersRepo -> getRowsByPost($startDate, $endDate, $city, $serviceId);
if ($petsitters === false) {
  $errorMessage = 'Erreur lors de la récupération des résultats.';
} 
var_dump($petsitters);

if (!empty($errorMessage)) {
  echo `$errorMessage`;
}




?>
