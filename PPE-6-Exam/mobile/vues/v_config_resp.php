
<form name="new_bug" method="POST" enctype="multipart/form-data" action="index.php?uc=dash&action=nouveau">
    <fieldset>
        <legend>Signalement d'un nouveau bug</legend>
        <p>
            <label for="objet">Objet : </label>
            <input id="objet" type="text" name="objet" size="50" maxlength="50" required="">
        </p>
        <p>
            <label for="libelle">Description du problème : </label>
            <textarea id="libelle" name="libelle" size="500" maxlength="500" required=""></textarea>
        </p>
        <p>
            <label for="apps">Application(s) concernées : </label>
            <select multiple id="apps" name="apps[]"required="">
                <?php
                foreach($the_products as $p){
                    echo '<option value="'.$p->getId().'">'.$p->getName().'</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <label for="file">Votre Capture:</label>
            <input type="file" name="file">
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000"/>
        </p>

        <p>
            <?php

            ?>
        </p>
        <p>
            <input type="submit" value="Valider" name="valider">
            <input type="reset" value="Annuler" name="annuler">
        </p>
    </fieldset>
</form>