
<?php
//Les photos devront être récupérée dans la bdd
  $nomParc = "parc1";
  //$photos = array("DSC_0053.JPG","DSC_0054.JPG","DSC_0055.JPG","DSC_0056.JPG");
  $photos = array("DSC_0053.JPG","DSC_0054.JPG","DSC_0055.JPG","DSC_0056.JPG","DSC_0057.JPG","DSC_0058.JPG");

 ?>



<div class="row"><!--cadre contenant les photos et les vignettes-->
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
      <div><!--cadre contenant les photos-->
      <?php
      $n = 0;

      //===Les jeux===//
      foreach ($p_imgs as  $p_img){
        echo '<div id="'.explode('.',$p_img['ip_img'])[0].'"';
        if($n != 0){
          echo ' style="display:none"';
        }
        echo '/>
        ';
        echo '<img src="img/'.$p_img['ip_img'].'" width="100%"/>';
        if($p_img['ip_parent_type'] == "jeu"){
          $p_jeu = $bdd->query('SELECT * FROM jeux WHERE j_id = '.$p_img['ip_parent_id'])->fetch();

          echo '<div style="border-style:solid;border-width:1px; margin-top:1em">
          '. $p_jeu['j_nom'] . ' '.$p_jeu['j_age_min'] . '-' . $p_jeu['j_age_max'].'ans <br>
            ' . $p_jeu['j_descr'] . '
          </div>';
        }
        echo '</div>';

        $n++;
      }
      //== Fin les jeux ==//
      ?>
    </div>
      <?php
      //===Sans caroussel===//
       if(count($photos) <= 4){echo'
        <div class="row" style=" padding-top:1em"><!--cadre des vignettes-->
          <div class="col-sm-2"></div>';
          //Les jeux
          foreach ($p_imgs as  $p_img) {
            echo '<div class="col-sm-2"><img  src="img/'.$p_img['ip_img'].'" width="150%"  onclick="changer('.explode('.',$p_img['ip_img'])[0].')"></div>
            ';
          }
          echo '<div class="col-sm-2"></div>
        </div>';
      }

      //===Avec caroussel===//
      else{
        $nbPhotosAffichees = 0;
        $nbPhotos = count($p_imgs);?>

    <div class="row"><!--cadre vignettes-->
      <div id="carouselExampleControls" class="carousel slide col-sm-12 " data-ride="carousel">
          <div class="carousel-inner">
            <?php while($nbPhotosAffichees < $nbPhotos){//boucle caroussel
              $nbPhotosAfficheesTemps = 0;
              if($nbPhotosAffichees == 0)
                echo '<div class="carousel-item active">';
              else
                echo '<div class="carousel-item">';
              ?>
              <div class="row" style="padding-top:1em">
                <div class="col-sm-2"></div>
                  <?php  while($nbPhotosAfficheesTemps <  4 and $nbPhotosAffichees < $nbPhotos){//boucle vignettes d'un niveau du caroussel
                    echo '<div class="col-sm-2"><img  src="img/'.$p_imgs[$nbPhotosAffichees]['ip_img'].'" width="140%"  onclick="changer('.explode('.',$p_imgs[$nbPhotosAffichees]['ip_img'])[0].')"></div>
                    ';
                    $nbPhotosAffichees++;
                    $nbPhotosAfficheesTemps++;
                  }?>
                <div class="col-sm-2"></div>
              </div>
            </div>
            <?php }?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
      </div>
    </div>
  <?php }//Fin caroussel
  ?>
  </div>
  <div class="col-sm-2"></div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script>
    //Entrée : nom d'une image
    //Cache tous les images sauf celle dont le nom est passé en paramètre.
    function changer(nomImageAMontrer){
      <?php foreach ($p_imgs as  $p_img) {
        echo '$("#'.explode('.',$p_img['ip_img'])[0].'").hide();
        ';
      }?>
      $(nomImageAMontrer).show();
    }
  </script>
