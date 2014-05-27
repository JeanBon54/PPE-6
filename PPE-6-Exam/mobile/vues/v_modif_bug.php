<form name="modif" method="POST" action="index.php?uc=dash&action=modif_statut" data-transition="flip" data-ajax="true">
    <div data-role="page">
        <div data-role="header">
            <h1>Modification</h1>
        </div>
        <div data-role="content">
            <h4>Page de modification d' un bug</h4>
            <p>Veuillez rentrer les informations ci dessous pour modifier le bug.</p>
                <div class="ui-field-contain">

                    <select name="status" id="status" data-native-menu="false">
                        <option value="choose-one" data-placeholder="true">Statut</option>
                        <option value="2">IN PROGRESSE</option>
                        <option value="3">CLOSE</option>
                    </select>
                </div>
                <div data-role="fieldcontain" class="ui-hide-label">
                    <form>
                       <input data-clear-btn="true" name="resume" id="resume" type="text" placeholder="Note technicien">
                    </form>
                </div>

                <a href="index.php?uc=dash" data-transition="slide" data-role="button">Mon Tableau de Bord</a>
                <input type="submit" data-transition="slide" id="note_tech" value="Valider" name="valider">
                <input type="reset" value="Annuler" name="annuler">

        </div>
        <!--<div data-role="footer" data-position="fixed">
            <h4>Pied de page</h4>
        </div> -->
    </div>
    </body>
    </html>
</form>