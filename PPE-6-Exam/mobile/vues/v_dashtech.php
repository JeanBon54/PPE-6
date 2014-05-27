<a id='lnkDialog' href="#ticket_dialog" data-transition="flip" style='display:none;'></a>

<div data-role="page">
    <div data-role="header">
        <form>

            <a href="index.php?uc=dash" data-transition='slide'data-role="button" data-inline="true">Tableau de bord</a>


            <a href="index.php?uc=deconnexion" data-transition='slide'data-role="button" data-inline="true">Se déconnecter</a>
        </form>
    </div>
    <div data-role="content">

            <div id="liste_tickets">

                    <h2>BUGS EN COURS</h2>
                    <h4>Pour afficher le ticket, appuyer sur la ligne correspondante</h4>
                    <div id="liste_tickets">
                        <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Colonnes à afficher..." data-column-popup-theme="a">
                            <thead>
                            <tr>
                                <th >Client</th>
                                <th data-priority="1">Statut</th>
                                <th data-priority="2">Date</th>
                                <th data-priority="3">Numéro</th>
                                <th data-priority="4">Priorité</th>
                            </tr>
                            </thead>
                            <?php
                            foreach($bugs_en_cours as $bug){
                                if ($bug->getReporter() != null){
                                    $reporter = $bug->getReporter()->getName();
                                }else{
                                    $reporter = "non affecté";
                                }
                                echo "<tr>";
                                echo "<td>".$reporter."</td>";
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
                                echo "<td>".$bug->getDelai()."</td>";

                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                    <br>
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
        <h3>Priorité :</h3><div id="priorite_ticket"></div>
        <h3>Capture d'écran : </h3><div id="capture"></div>
    </div>
    <hr>
    <form id="form_resolu" method="post" action="index.php?uc=dash&action=modifier_statut">
        <h2>Changement de statut</h2>
        <input type="hidden" name="idBug" value="<?php echo $bug->getId();?>">
        <select id="statut" name="statut">
            <option value="CLOSE">CLOSE</option>
            <option value="IN PROGRESS">IN PROGRESS</option>
        </select><br><br>
        Ajouter une note<br>
        <textarea name="resume" required=""></textarea><br><br>
        <input type="submit" value="Valider">
    </form>

</div>
