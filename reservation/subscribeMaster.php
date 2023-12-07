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
          Je veux faire garder mon animal
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
          <div>
            <input type="text" name="animalName" class="form-control mt-3 pt3 pb3" placeholder="Nom de votre animal" aria-label=".form-control-lg example"> 
          </div>
          <div>
            <input type="texte" name="race" class="form-control mt-3 pt3 pb3" placeholder="Race de votre animal" aria-label=".form-control-lg example"> 
          </div>
          <div class="form-floating">
            <textarea name="description" class="form-control mt-3" placeholder="Décrivez le caractère de votre animal" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Décrivez le caractère de votre animal</label>
          </div>
          <div>
            <select id="animalType" name = "animalType" class="form-select shadow-sm pt3 pb3 mt-3">
                <option value="" class="text-muted">Quel est le type de votre animal ?</option>
                <?php foreach ($animalTypes as $animalType) : ?>  
                  <option value="<?= $animalType['idanimalType']?>"><?= $animalType['type']?></option>
                <?php endforeach ?>
            </select>
          </div>
          <div>
          <select id="yearBirth" name = "yearBirth" class="form-select shadow-sm pt3 pb3 mt-3">
              <option value="">Quelle est l'année de naissance de votre animal ?</option>
              <?php for($i= 2023 ; $i >2009 ; $i--) : ?>
                <option value="<?= $i ?>"><?=$i?></option>
              <?php endfor ?>
            </select>
          </div>
          <div>
          <select id="gender" name = "gender" class="form-select shadow-sm pt3 pb3 mt-3">
              <option value="">Quel est le genre de votre animal ?</option>
              <option value="female">Femelle</option>
              <option value="male">Mâle</option>
            </select>
          </div>
          <div>
          <select id="size" name = "size" class="form-select shadow-sm pt3 pb3 mt-3">
              <option value="">Quelle est la taille de votre animal ?</option>
              <?php foreach ($sizes as $size) : ?>
                <option value="<?= $size['idsize']?>"><?= $size['size']?></option>
              <?php endforeach ?>
            </select>
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