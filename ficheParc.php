<?php
//Recupération des données
if(!isset($_GET['parc'])){
  echo 'Veuillez donner un parc.';
  exit();
}
$p_id = $_GET['parc'];
$bdd = new PDO('mysql:host=localhost:3306;dbname=jouerbou_nancy;charset=utf8', 'jouerbou', 'Beuzec29');
//Le parc
$parc = $bdd->query('SELECT * FROM parcs WHERE p_id = ' . $p_id)->fetch();
//Adresse du parc
$p_add = $bdd->query('SELECT * FROM addr WHERE ad_id = ' . $parc['p_ad_id'])->fetch();
//Photos du parc
$p_imgs = $bdd->query('SELECT * FROM imgs_parc WHERE (ip_parent_type="parc" AND ip_parent_id = ' . $parc['p_id'].') OR (ip_parent_type="jeu" AND ip_parent_id IN (SELECT j_id FROM jeux WHERE j_p_id = '.$parc['p_ad_id'].'))')->fetchAll();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Carousel Template for Bootstrap</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  </head>
  <body>

    <header style="padding:30px">
      <?php include 'navigation.php'?>
    </header>

    <main role="main" style="width:100%">
      <div class="row">
        <div class="col-lg-6" style="height:500px; background-color:red; padding-top:2em">

            <?php  include 'ficheParcsPhotos.php' ?>
              </div>
        </div>
        <div class="col-lg-6"style="background-color:green">
            <?php include 'ficheParcsdescriptif.php' ?>
        </div>
      </div>
      <div style="background-color:blue;" class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
          <!--<iframe src="https://www.google.com/maps/d/embed?mid=1rBWoJm6TUOpDK3T_kbmBFmXXN3FHy0gC" width="640" height="480"></iframe>-->
        </div>
        <div class="col-sm-2"></div>
      </div>
    </main>

  </body>
</html>
