<?php
$bdd = new PDO('mysql:host=localhost:3306;dbname=jouerbou_nancy;charset=utf8', 'jouerbou', 'Beuzec29');
if(!isset($_GET['recherche'])){
  $parcs = $bdd->query('SELECT * FROM parcs, addr WHERE ad_id = p_id');
}
elseif($_GET['recherche'] == "villes"){
  $parcs = $bdd->query('SELECT * FROM parcs, addr WHERE ad_id = p_id AND ad_ville = "' . $_GET['ville'] . '"');
}
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
        <!--Affichage du resultat-->
        <div class="col-lg-6">
          <table>
            <tr><th>Nom</th><th>Ville</th><th>Adresse</th><th>Nombre jeux</th></tr>
            <?php
            foreach ($parcs as $parc) {
              $nb_jeux = $bdd->query('SELECT COUNT(*) FROM jeux WHERE j_p_id = ' . $parc['p_id'])->fetch();
              echo "<tr><td><a href=\"ficheParc.php?parc=" . $parc['p_id'] . "\">" . $parc['p_nom'] . "</a></td><td>" . $parc['ad_ville'] . "</td><td>" . $parc['ad_num'] . " " . $parc['ad_rue'] . "</td><td>" . $nb_jeux[0] . "</td></tr>";
              }
            ?>
          </table>
        </div>
        <!--Recherche du resultat-->
        <div class="col-lg-6">
          <form method="get" action="#">
            <select name="ville">
              <?php
              $resVilles = $bdd->query('SELECT DISTINCT ad_ville FROM addr');
              while($ville = $resVilles->fetch()) {
                echo '<option value="' . $ville['ad_ville'] . '">' . $ville['ad_ville'] . '</option>';
              }
               ?>
            </select>
            <input type="submit"/>
            <input type="hidden" value="villes" name="recherche" />
          </form>
        </div>
      </div>


    </main>

  </body>
</html>
