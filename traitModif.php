<?php
  include ("fonction/lib.php");
  errorLog(); // Je là desactive pour la recherche vide
  include "template/header.php";
  include "template/menu.php";

  //Connexion BDD
  $bdd = connectDB();
  $voiture = afficheVoiture();
?>

<h3>Modification voiture</h3>

<?php
if(isset($_POST['choix'])){
  foreach ($_POST['choix'] as $multi) {
  $tab = array(
      ':idVoit'  => $multi
  );
    $res = selectVoitAll($multi);
  }
//  print_r($res); // Vérification des données entrées
}

?>
<div class="row justify-content text-center">
  <div class="col-md-3">
    <?php foreach($res as $marque) { ?>
      <label><?=$marque['Marque']?></label>
    <?php } ?>
  </div>
  <div class="col-md-3">
    <?php foreach($res as $types) { ?>
    <label><?=$types['idTYPE_VOIT']?></label>
    <?php } ?>
  </div>
  <div class="col-md-3">
    <?php foreach($res as $agences) { ?>
    <label><?=$agences['idAGENCE']?></label>
    <?php } ?>
  </div>
  <div class="col-md-3">
    <?php foreach($res as $img) { ?>
      <label><?=$img['Image']?></label>
    <?php } ?>
  </div>
</div>

<form enctype="multipart/form-data" action="traitModif.php" method="post">
  <div class="row">
    <div class="col-md-2">
      <?php foreach($res as $id) { ?>
        <input class="form-control" type="text" name="id" value="<?=$marque['idVOITURE']?>"><br>
      <?php } ?>
    </div>
    <div class="col-md-2">
      <?php foreach($res as $marque) { ?>
        <input class="form-control" type="text" name="marque" value="<?=$marque['Marque']?>"><br>
      <?php } ?>
    </div>
    <div class="col-md-2">
      <select class="form-control" required name="type">
        <option disabled selected value="">Types</option>
        <?php foreach($res as $types) { ?>
        <option value="<?=$types['idTYPE_VOIT']?>">
          <?=$types['idTYPE_VOIT']?>
        </option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-2">
      <select class="form-control" required name="agence">
        <option disabled selected value="">Agences</option>
        <?php foreach($res as $agences) { ?>
        <option value="<?=$agences['idAGENCE']?>">
          <?=$agences['idAGENCE']?>
        </option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-2">
      <?php foreach($res as $img) { ?>
        <input class="form-control" type="text" name="image" value="<?=$img['Image']?>"><br>
      <?php } ?>
    </div>
    <div class="col-md-12 d-flex justify-content-end">
      <input class="btn btn-danger btnEdit" type="submit" value="Valider"/>
    </div>
  </div>
</form>

<?php

if (isset($_POST['marque'])){
  if (isset($_POST['image'])){
    if (isset($_POST['id'])){
      //Filtre les données entrées
      $filtreMarque = filter_var($_POST['marque'], FILTER_SANITIZE_STRING);
      $filtreImage = filter_var($_POST['image'], FILTER_SANITIZE_STRING);

      $resType = ($_POST['type']);
      $resAgence = ($_POST['agence']);
      $id = ($_POST['id']);

      $idType = selectTypeId($resType);
      $idAgence = selectAgenceId($resAgence);
    //  $idVoit = selectVoitIdComplexe($id)

      foreach ($idAgence as $value1) {
      foreach ($idType as $value2) {
    //  foreach ($idVoit as $value3) {

        $tabUp = array(
          ':marque'  => $filtreMarque,
          ':idAgence'  => $value1,
          ':idType'  => $value2,
          ':image'  => $filtreImage,
          ':idVoit'  => $value3
        );
      }

      $verif = selectVoitIdComplexe($filtreMarque, $value1, $value2, $filtreImage, $value3);
    }
  }
}
print_r($verif); // Vérification nickel :)
  }

?>

<?php
  include "template/footer.php";
?>
