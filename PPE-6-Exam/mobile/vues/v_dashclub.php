<a id='lnkDialog' href="#ticket_dialog" data-transition="flip" style='display:none;'></a>

<div data-role="page">
    <div data-role="header">
<form>

    <a href="index.php?uc=dash" data-transition="flip" data-role="button" data-inline="true">Mon tableau de bord </a>

    <a href="index.php?uc=dash&action=nouveau" data-transition="flip" data-role="button" data-inline="true"> Nouvel incident</a>

    <a href="index.php?uc=deconnexion"  data-transition="flip" data-role="button" data-inline="true"> Se déconnecter </a>


</form>
    </div>
    <div data-role="content">
        <h4>Bienvenue sur votre console de gestion</h4>

        <div data-role="collapsible-set" data-theme="b" data-content-theme="a">
            <div id="liste_tickets">
            <div data-role="collapsible" data-collapsed="true">
                <h3>Tickets en cours</h3>
                <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Colonnes à afficher..." data-column-popup-theme="a">
                   <thead>
                    <tr>
                        <th>Numéro</th>

                        <th>Date</th>
                        <th data-priority="1">Objet</th>
                        <th data-priority="2">Numéro</th>
                        <th data-priority="3">Produits concernés</th>
                    </tr>
                   </thead>
                    <?php
                    foreach ($bugs_en_cours as $bug) {
                        if ($bug->getEngineer() != null){
                            $engineer = $bug->getEngineer()->getName();
                        }else{
                            $engineer = "non affecté";
                        }
                        echo "<tr>";
                        echo "<td class='colonneid'>".$bug->getId()."</td>";
                        echo "<td class='colonnedate'>".$bug->getCreated()->format('d.m.Y')."</td>";
                        echo "<td class='colonnetech'>".$bug->getObjet()."</td>";
                        echo "<td>".$bug->getId()."</td>";
                        echo "<td class='colonneprod'>";
                        foreach ($bug->getProducts() as $product) {
                            echo "- ".$product->getName()." ";
                        }
                        echo "</td>";
                        //echo "<li>".$bug->getDescription()."</li>";
                        echo "</tr>";
                    }
                    ?>


                </table>
            </div>
        </div>
            <br>
        <hr>


            <div data-role="collapsible">
                <h3>Tickets cloturés</h3>
                <p>
                <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Colonnes à afficher..." data-column-popup-theme="a">
                   <thead>
                    <tr>
                        <th>Date</th>
                        <th data-priority="1">Résumé résolution</th>
                        <th data-priority="2">Technicien</th>
                        <th data-priority="3">Numéro</th>
                        <th data-priority="4">Produits concernés</th>
                    </tr>
                   </thead>
                    <?php
                    foreach ($bugs_fermes as $bug) {
                        if ($bug->getEngineer() != null){
                            $engineer = $bug->getEngineer()->getName();
                        }else{
                            $engineer = "non affecté";
                        }
                        echo "<tr>";
                        echo "<td class='colonnedate'>".$bug->getCreated()->format('d.m.Y')."</td>";
                        echo "<td class='colonnetech'>".$bug->getResume()."</td>";
                        echo "<td class='colonnetech'>".$engineer."</td>";
                        echo "<td class='colonneid'>".$bug->getId()."</td>";
                        echo "<td class='colonneprod'>";
                        foreach ($bug->getProducts() as $product) {
                            echo "- ".$product->getName()." ";
                        }
                        echo "</td>";

                        //echo "<td>".$bug->getDescription()."</td>";
                        echo "</tr>";
                    }
                    ?>

                </table>
                </p>
            </div>
            </div>
        </div>
    </div>
    <div data-role="footer" data-position="fixed">
        <h4>Pied de page</h4>
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
</div>

</body>
</html>