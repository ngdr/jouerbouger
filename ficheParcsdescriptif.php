<div class="row" style="padding:2em">
  <div class="col-sm-2"></div>
  <div class="col-sm-8" >
    <div style="border-style:solid;border-width:1px">
      <h1> <?php echo $parc['p_nom'];?></h1>
      <ul>
        <li>Soleil : <?php echo $parc['p_soleil'];?></li>
        <li>Fermé : <?php echo $parc['p_ferme'];?></li>
        <li>Taille : <?php echo $parc['p_taille'];?></li>
        <li>Age : <?php echo $parc['p_age_min'];?>-<?php echo $parc['p_age_max'];?>ans </li>
        <li> Adresse : <?php echo $p_add['ad_num'] . ' ' . $p_add['ad_rue'];?></li>
        <li><?php echo $p_add['ad_ville']; ?></li>
        <li>Prix : <?php echo $parc['p_prix'];?></li>
        <li>Accessible : <?php echo $parc['p_acc'];?></li>
        <li>Voiture : <?php echo $parc['p_voiture'];?></li>
      </ul>
    </div>
  </div>
  <div class="col-sm-2"></div>
</div>
