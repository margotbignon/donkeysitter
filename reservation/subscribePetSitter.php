<?php

require 'templates/header-var.php';

?>

<div class="container-lg">
    <div class="row mt-5">

    <!-- Empty columns left -->    
    <div class="col-md-3"></div>

    <!-- Form -->
    <div class="col-md-6">
      <form action="" method="post">
        <div class="bg-white shadow rounded-4 border-0 search-column py-4 px-5 mb-5">
          <div class="text-hero-bold text-center">
          Je veux devenir Pet Sitter
          </div>
          <div class="d-flex justif-content-space-between">
            <input type="text" name="firstname" class="form-control me-2 pt3 pb3" placeholder="Nom" aria-label=".form-control-lg example">
            <input type="text" name="lastname" class="form-control ms-2" placeholder="Prénom" aria-label=".form-control-lg example">
          </div>
          <div>
            <input type="email" name="email" class="form-control mt-3 pt3 pb3" placeholder="Adresse email" aria-label=".form-control-lg example"> 
          </div>
          <div class="d-flex justif-content-space-between">
            <input type="password" name="password" class="form-control me-2 pt3 pb3 mt-3" placeholder="Mot de passe" aria-label=".form-control-lg example">
            <input type="password" name="confirmpassword" class="form-control ms-2 mt-3" placeholder="Confirmer le mot de passe" aria-label=".form-control-lg example">
          </div>  
          <div>
            <input type="text" name="adresse" class="form-control mt-3 mb-3 pt3 pb3" placeholder="Adresse" aria-label=".form-control-lg example"> 
          </div>
          <div class="d-flex justify-content-space-between">
            <input type="text" name="city" class="form-control me-2 pt3 pb3" placeholder="Ville" aria-label=".form-control-lg example">
            <input type="text" name="postalCode" class="form-control ms-2 pt3 pb3" placeholder="Code postal" aria-label=".form-control-lg example">
          </div>
          <div>
            <input type="phone" name="phoneNb" class="form-control mt-3 pt3 pb3" placeholder="N° de téléphone" aria-label=".form-control-lg example"> 
          </div>
          <div class="d-flex justify-content-space-between pt-3">
            <div class="d-flex">
              <label type="text" class="text-label-regular align-items-center mt-3 pe-3">Votre date de naissance :</label>
            </div>
          
          <input type="date" name="birthDate" class="shadow-sm pt3 pb3 mb-4 px-3 me-3 border rounded"  value="Date de naissance"/>
          </div>
          <div>
            <label for="attachFile" class="text-label-regular mb-3">Photo de profil :</label>
            <input type="file" name="profilPicture" placeholder = "Photo de Profil">
          </div>
          <div class="form-floating">
            <textarea name="description" class="form-control mt-3" placeholder="Décrivez votre expérience en tant que pet sitter" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Décrivez votre expérience en quelques lignes</label>
          </div>
          <div>
          <label for="text" class="text-label-regular mt-3">Avez-vous un animal ?</label>
            <select id="animalType" name = "animalType" class="form-select shadow-sm pt3 pb3 mt-3">
                <option value="" class="text-muted">Sélectionnez un type</option>
                <?php foreach ($animalTypes as $animalType) : ?>  
                  <option value="<?= $animalType['idanimalType']?>"><?= $animalType['type']?></option>
                <?php endforeach ?>
            </select>
          </div>
          <fieldset class="d-flex flex-column align-items-start mt-3 w-75">
                <p class="text-label-regular">Animaux acceptés :</p>
                
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="">
                        <label class="form-check-label" for="flexCheckDefault">
                        
                        </label>
                    </div>
                
            </fieldset>
            <div class="mt-3">
            <p class="text-label-regular">Nombre d'années d'expérience en garde d'animaux :</p>
            <input type="number" name="nbExperience" placeholder = "0" class="form-control mt-3 pt3 pb3">
            </div>
            <div class="mt-3">
            <p class="text-label-regular">Nombre maximum d'animaux à garder :</p>
            <input type="number" name="animalMax" placeholder = "0" class="form-control mt-3 pt3 pb3">
            </div>
            <div class="div row mb-3">
              <div class="col-md-4 align-middle">
                <div class="text-hero-regular text-center text-md-start">Prestation :</div>
              </div>

              <div class="d-flex align-items-center mb-3 fw-bold pb-3">
              <div class="p-2 flex-fill">
              <label class="btn-checkbox me-4 border">
                  <input type="checkbox" autocomplete="off">Hébergement
                </label>
              </div>
              <div class="p-2 ms-4 flex-fill">
              <label class="btn-checkbox me-4 border">
                  <input type="checkbox" autocomplete="off">Garde à domicile
                </label> 
              </div>
            </div>
            
          
          <div class="cta d-grid gap-2 pt-3">
            <input type="submit" class="btn btn-primary" value="Je m'inscris !">
          </div>
        </div>
      </form>
    </div>

    <!-- Empty columns right -->    
    <div class="col-md-3"></div>

    </div>

</div>