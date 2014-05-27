<?php
/**
 * Created by PhpStorm.
 * User: Gatien
 * Date: 31/03/14
 * Time: 10:31
 */
$bug = getOneBug($_GET["bug"]);
echo "Bug n°".$bug->getId()."<br>Description : ".$bug->getDescription()."<br>Crée le : ".$bug->getCreated()->format('d.m.Y')."<br><br>Capture d'écran : <br><img style='width:800px' src='upload/".$bug->getCapture()."'>";
//var_dump($bug);
?>

<h2>Que voulez vous faire ?</h2>
<FORM>
    <INPUT type= "radio" name="radio" id="resolu" value="resolu" onclick="form_resolu();">Changer le statut<br><br>
    <INPUT type= "radio" name="radio" id="affecter" value="affecter" onclick="form_affecter();">Affecter à un technicien
</FORM>
<hr>

<form id="form_resolu" method="post" action="index.php?uc=dash&action=modifier_statut">
    <h3>Changement de statut</h3>
    <input type="hidden" name="idBug" value="<?php echo $bug->getId();?>">
    <select id="statut" name="statut">
        <option value="CLOSE">CLOSE</option>
        <option value="IN PROGRESS">IN PROGRESS</option>
    </select><br><br>
    Ajouter une note<br>
    <textarea name="resume" required=""></textarea><br><br>
    <input type="submit" value="Valider">
</form>
<form id="form_affecter" method="post" action="index.php?uc=dash&action=affecter">
    <input type="hidden" name="idBug" value="<?php echo $bug->getId();?>">
    Technicien : <select name="idTech">
    <?php
        foreach($techniciens as $tech) {
            echo "<option value=".$tech->getId().">".$tech->getName()." ".$tech->getPrenom()."</option>";
        }
    ?>
    </select>
    <br><br>
    Priorité :
    <select name="delai">
        <option>Haute</option>
        <option>Moyenne</option>
        <option>Basse</option>
    </select>
    <br>
    <br>
    <input type="submit" value="Affecter">
</form>
<script>
    $( document ).ready(function() {
        $('#form_resolu').fadeOut(1);
        $('#form_affecter').fadeOut(1);
    });
    function form_resolu() {
        $('#form_resolu').fadeOut(1);
        $('#form_affecter').fadeOut(1);
        $('#form_resolu').fadeIn(1);
    }
    function form_affecter() {
        $('#form_resolu').fadeOut(1);
        $('#form_affecter').fadeOut(1);
        $('#form_affecter').fadeIn(1);
    }
</script>