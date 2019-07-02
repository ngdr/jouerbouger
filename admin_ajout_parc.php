<?php
$bdd = new PDO('mysql:host=localhost:3306;dbname=jouerbou_nancy;charset=utf8', 'jouerbou', 'Beuzec29');

if(!isset($_POST['p_envoye'])){?>

<form action="#" method="post"><table>
  <tr><td>Nom :</td><td> <input type="text" name="p_nom" /></td></tr>
  <tr><td>Adresse rue :</td><td> <input type="number" size="4" width="4em" name="ad_num" placeholder="3" />  <input type="text" name="ad_rue" placeholder="rue du parc" /></td></tr>
  <tr><Td>Adresse ville : </td><td><input type="text" name="ad_ville" placeholder="Nancy"/> CP <input type="number" size="5" name="ad_cp" placeholder="54000    " /></td></tr>
  <tr><td>Soleil : </td><td>oui : <input type="radio" value="oui" name="p_soleil"/> non <input type="radio" value="non" name="p_soleil" /></td></tr>
  <tr><td>Fermé : </td><td>oui : <input type="radio" value="oui" name="p_ferme"/> non <input type="radio" value="non" name="p_ferme" /></td></tr>
  <tr><td>Taille : </td><td><input type="number" name="p_taille"/></td></tr>
  <tr><td>Age : </td><td> min : <input type="number" name="p_age_min" size="3" minlength="3"/>max : <input type="number" name="p_age_max"/></td></tr>
  <tr><td>Prix : </td><td><input type="number" name="p_prix" value="0"/></td></tr>
  <tr><td>Acces handicapé : </td><td>oui : <input type="radio" value="oui" name="p_acc"/> non <input type="radio" value="non" name="p_acc" /></td></tr>
  <tr><td>Acces voiture : </td><td>oui : <input type="radio" value="oui" name="p_voiture"/> non <input type="radio" value="non" name="p_voiture" /></td></tr>
  <tr><td colspan="2"><input type="hidden" value="Envoyer_parc" name="p_envoye"/><input type="submit" value="Envoyer" /></td></tr>
</form></table>

<?php
}
elseif($_POST['p_envoye'] ==  "Envoyer_parc"){
  //L'adresse
  $bdd->query("INSERT INTO `addr` (`ad_num`, `ad_rue`, `ad_ville`, `ad_cp`) VALUES ('" . $_POST['ad_num'] . "', '" . $_POST['ad_rue'] . "', '" . $_POST['ad_ville'] . "', '" . $_POST['ad_cp'] . "');");
  $p_add = $bdd->lastInsertId();
  //Le parc
  $bdd->query('INSERT INTO `parcs` (`p_nom`, `p_ad_id`, `p_soleil`, `p_ferme`, `p_taille`, `p_age_min`, `p_age_max`, `p_prix`, `p_acc`, `p_voiture`) VALUES ("' . $_POST['p_nom'] . '", "' . $p_add . '",  "' . $_POST['p_soleil'] . '",  "' . $_POST['p_ferme'] . '",  "' . $_POST['p_taille'] . '",  "' . $_POST['p_age_min'] . '",  "' . $_POST['p_age_max'] . '",  "' . $_POST['p_prix'] . '",  "' . $_POST['p_acc'] . '",  "' . $_POST['p_voiture'] . '")');
  $parc_id = $bdd->lastInsertId();

  //Form images
 ?>
 Images globales du parc
 <form action="#" enctype="multipart/form-data"  method="post"><table>
  <input type="hidden" name="p_id" value=<?php echo '"'.$parc_id.'"';?>/>
   <tr><td>Image :</td><td> <input type="file" name="p_img1" /></td></tr>
   <tr><td>Image :</td><td> <input type="file" name="p_img2" /></td></tr>
   <tr><td>Image :</td><td> <input type="file" name="p_img3" /></td></tr>
   <tr><td colspan="2"> <input type="submit" value="Envoyer" /><input type="hidden" value="Envoyer_img" name="p_envoye"/></td></tr>
 </form></table>
 <?php
}
//Reception des images du parc.
elseif($_POST['p_envoye'] == "Envoyer_img"){
  $parc_id = $_POST['p_id'];
  foreach ($_FILES as $nom_img => $value) {
    if(is_uploaded_file($_FILES[$nom_img]['tmp_name'])){
      $uploadfile = "./img/". $_FILES[$nom_img]['name'];

      if ($a = move_uploaded_file($_FILES[$nom_img]['tmp_name'], $uploadfile)) {
        echo "Le fichier ".$_FILES[$nom_img]['name']." est valide, et a été téléchargé avec succès.<br>";}
      else {
        echo "Erreur dans le téléchargement du fichier " . $_FILES[$nom_img]['name'] . "<br>";}
      $bdd->query('INSERT INTO imgs_parc VALUES(NULL, "' . $_FILES[$nom_img]['name'] . '", "' . $parc_id . '", "parc")');
      }
    }?>
    <form action="#" method="post" enctype="multipart/form-data">
      Ajouter des jeux :  <input type="submit" value="oui" />
      <input type="hidden" value="jeux" name="p_envoye"/>
      <input type="hidden" name="nvl_jeux" value="oui" />
      <input type="hidden" name="p_id" value=<?php echo '"'.$parc_id.'"';?>/>
    </form><php
  <?php
  }
elseif($_POST['p_envoye'] == "jeux"){
  $parc_id = $_POST['p_id'];
  //Form jeux
  if($_POST['nvl_jeux'] == "oui"){
    ?>
    <form action="#" method="post" enctype="multipart/form-data"><table>
      <input type="hidden" name="p_id" value=<?php echo '"'.$parc_id.'"';?>/>
      <tr><td>Nom :</td><td> <input type="text" name="j_nom" /></td></tr>
      <tr><td>Type :</td><td> <input type="text" name="j_type" /></td></tr>
      <tr><td>Age :</td><td> min <input type="number" name="j_age_min" /> max <input type="number" name="j_age_max" /></td></tr>
      <tr><td>Image :</td><td> <input type="file" name="j_img" /></td></tr>
      <tr><td colspan="2"><textarea name="j_desc"></textarea></td></tr>
      <tr><td>Autre jeux ? </td><td><input type="radio" value="oui" name="nvl_jeux"/></td></tr>
      <tr><td colspan="2"><input type="hidden" name="p_envoye" value="jeux"/><input type="submit" value="Envoyer" /></td></tr>
    </table></form>
  <?php
}
  //Jeux to bdd
  if(isset($_POST['j_type'])){
    $a = $bdd->query("INSERT INTO `jeux` (`j_nom`, `j_type`, `j_p_id`, `j_age_min`, `j_age_max`, `j_descr`) VALUES ('" . $_POST['j_nom'] . "', '" . $_POST['j_type'] . "', '" . $parc_id . "', '" . $_POST['j_age_min'] . "', '" . $_POST['j_age_max'] . "', '" . $_POST['j_desc'] . "');");
    if(is_uploaded_file($_FILES['j_img']['tmp_name'])){
      $uploadfile = "./img/". $_FILES['j_img']['name'];

      if ($a = move_uploaded_file($_FILES['j_img']['tmp_name'], $uploadfile)) {
        echo "Le fichier ".$_FILES['j_img']['name']." est valide, et a été téléchargé avec succès.\n";}
      else {
        echo "Erreur dans le téléchargement du fichier " . $_FILES['j_img']['name'] . "\n";}
      $bdd->query('INSERT INTO imgs_parc VALUES(NULL, "' . $_FILES['j_img']['name'] . '", "' . $bdd->lastInsertId() . '", "jeu")');
      }
  }
}

  ?>
