<a id='lnkDialog' href="#ticket_dialog" data-transition="flip" style='display:none;'></a>

<div data-role="page">
    <div data-role="header">
        <form>

                <a href="index.php?uc=dash" data-transition='slide'data-role="button" data-inline="true">Tableau de bord</a>


                <a href="index.php?uc=deconnexion" data-transition='slide'data-role="button" data-inline="true">Se déconnecter</a>
        </form>
    </div>
    <div data-role="content">
        <div data-role="collapsible-set" data-theme="b" data-content-theme="a">
            <div id="liste_tickets">
                <div data-role="collapsible" data-collapsed="true">

<h2>BUGS EN COURS</h2>
    <h4>Pour afficher le ticket, appuyer sur la ligne correspondante</h4>
<div id="liste_tickets">
    <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Colonnes à afficher..." data-column-popup-theme="a">
        <thead>
        <tr>
            <th >Technicien</th>
            <th data-priority="1">Statut</th>
            <th data-priority="3">Date</th>
            <th data-priority="4">Numéro</th>
        </tr>
        </thead>
        <?php
        foreach($bugs_en_cours as $bug){
            if ($bug->getEngineer() != null){
                $engineer = $bug->getEngineer()->getName();
            }else{
                $engineer = "non affecté";
            }
            echo "<tr>";
            echo "<td>".$engineer."</td>";
            //echo "<td>".$bug->getReporter()->getName()."</td>";
            //echo "<td>".$bug->getDescription()."</td>";
            if($bug->getStatus()=="IN PROGRESS"){
                echo "<td>En cours</td>";
            }
            else {
                echo "<td>Ouvert</td>";
            }
            echo "<td>".$bug->getCreated()->format('d.m.Y')."</td>";
            echo "<td>".$bug->getId()."</td>";
            echo "</tr>";
        }
        ?>
    </table>
    </div>
</div>
<br>
</div>

<hr>
                <div data-role="collapsible">
<h2>BUGS FERMES</h2>
<div id="liste_tickets_fermes">
    <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Colonnes à afficher..." data-column-popup-theme="a">
    <thead>
        <tr>
            <th >Technicien</th>
            <th data-priority="1">Résumé</th>
            <th data-priority="3">Date</th>
            <th data-priority="4">Statut</th>
        </tr>
    </thead>
    <?php
    foreach($bugs_fermes as $bug){
        if ($bug->getEngineer() != null){
            $engineer = $bug->getEngineer()->getName();
        }else{
            $engineer = "non affecté";
        }

        echo "<tr>";
        echo "<td>".$engineer."</td>";
        //echo "<td>".$bug->getReporter()->getName()."</td>";
        //echo "<td>".$bug->getDescription()."</td>";
        echo "<td>".$bug->getResume()."</td>";
        echo "<td>".$bug->getCreated()->format('d.m.Y')."</td>";
        echo "<td>".$bug->getStatus()."</td>";
        echo "</tr>";
    }

    ?>
</table>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
<div data-role="dialog" id="ticket_dialog">
    <div data-role="header">
        <h1>Detail du ticket <div id="id_ticket"></div></h1>
    </div>
    <div data-role="content">
        <h3>Date :</h3><div id="date_ticket"></div>
        <h3>Description :</h3><div id="descri_ticket"></div>
        <h3>Capture d'écran : </h3><div id="capture"></div>
    </div>
    <hr>
    <fieldset data-role="controlgroup">
        <legend>Que voulez vous faire ?</legend>
        <input name="radio-choice-1" id="radio-choice-1" value="choice-1" checked="checked" type="radio" onclick="form_resolu(); ">
        <label for="radio-choice-1">Changer le statut</label>
        <input name="radio-choice-1" id="radio-choice-2" value="choice-2" type="radio" onclick="form_affecter();">
        <label for="radio-choice-2">Affecter à un technicien</label>
    </fieldset>

    <form id="form_resolu" method="post" action="index.php?uc=dash&action=modifier_statut">
        <h2>Changement de statut</h2>
        <input type="hidden" name="idBug_statut" id="idBug_statut" value="">
        <select id="statut" name="statut">
            <option value="CLOSE">CLOSE</option>
            <option value="IN PROGRESS">IN PROGRESS</option>
        </select><br><br>
        Ajouter une note<br>
        <textarea name="resume" required=""></textarea><br><br>
        <input type="submit" value="Valider">
    </form>
    <form id="form_affecter" method="post" action="index.php?uc=dash&action=affecter">
        <h2>Affectation</h2>
        <input type="hidden" name="idBug_affecter" id="idBug_affecter" value="">

        <label for="select-choice-a" class="select">Technicien :</label>
        <select name="idTech" id="select-choice-a" data-native-menu="false">
            <option>Liste des techniciens : </option>
            <?php
            foreach($techniciens as $tech) {
                echo "<option value=".$tech->getId().">".$tech->getName()." ".$tech->getPrenom()."</option>";
            }
            ?>
        </select>
        <br><br>
        <fieldset data-role="controlgroup">
            <legend>Priorité :</legend>
            <input name="delai" id="radio-choice-1" value="Haute" checked="checked" type="radio">
            <label for="radio-choice-1">Haute</label>
            <input name="delai" id="radio-choice-2" value="Moyenne" type="radio">
            <label for="radio-choice-2">Moyenne</label>
            <input name="delai" id="radio-choice-3" value="Basse" type="radio">
            <label for="radio-choice-3">Basse</label>
        </fieldset>
        <br>
        <br>
        <input type="submit" value="Affecter">
    </form>


</div>

<script>
    $( document ).ready(function() {
        $('#form_resolu').fadeOut(1);
        $('#form_affecter').fadeOut(1);
    });
    function form_resolu() {

        $('#form_resolu').fadeOut(1);
        $('#form_affecter').fadeOut(1);
        $('#form_resolu').fadeIn(1);
        $(window).scrollTop($("#form_resolu").offset().top);
    }
    function form_affecter() {
        $('#form_resolu').fadeOut(1);
        $('#form_affecter').fadeOut(1);
        $('#form_affecter').fadeIn(1);
        $(window).scrollTop($("#form_affecter").offset().top);
    }
</script>
