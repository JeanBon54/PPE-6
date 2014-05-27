<form name="reolution_bug" method="POST" enctype="multipart/form-data" action="index.php?uc=dash&action=modifier_statut">
    <fieldset>
    <legend>Résolution d'un nouveau bug</legend>
    <p>
        <label for="objet">Statut </label>
        <input id="statut" type="text" name="objet" size="50" maxlength="50" required="">
    </p>
    <p>
        <label for="libelle">Description </label>
        <textarea id="description" name="libelle" size="500" maxlength="500" required=""></textarea>
    </p>

        <input type="submit" value="Valider" name="valider">
        <input type="reset" value="Annuler" name="annuler">
    </p>
    </fieldset>
</form>