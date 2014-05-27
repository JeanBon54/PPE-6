<?php
$bug = getOneBug($_GET["bug"]);
echo "Bug n°".$bug->getId()."<br>Description : ".$bug->getDescription()."<br>Crée le : ".$bug->getCreated()->format('d.m.Y')."<br><br>Capture d'écran : <br><img style='width:800px' src='upload/".$bug->getCapture()."'>";
//var_dump($bug);
?>

<h2>MODIFIER LE STATUT D'UN INCIDENT</h2>
<hr>

<form id="form_resolu" method="post" action="index.php?uc=dash&action=modifier_statut">
    <h3>Changement de statut</h3>
    <input type="hidden" name="idBug" value="<?php echo $bug->getId();?>">
    <select id="statut" name="statut">
        <option value="CLOSE">CLOSE</option>
        <option value="IN PROGRESS">IN PROGRESS</option>
    </select><br><br>
    Ajouter une note<br>
    <textarea name="resume"></textarea><br><br>
    <input id="note_tech"type="submit" value="Valider">
</form>