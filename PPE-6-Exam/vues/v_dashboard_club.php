
<div id="liste_tickets">
    <h2>Tickets en cours</h2>
<table cellspacing="0">
<tr><th></th><th>Crée le</th><th>Produit concerné</th><th>Description</th></tr>

    <?php
foreach ($bugs_en_cours as $bug) {
    if ($bug->getEngineer() != null){
        $engineer = $bug->getEngineer()->getName();
    }else{
        $engineer = "non affecté";
    }
    echo "<tr>";
    echo "<td><img src='./images/en_cours.png' width='30px' height='30px'/></td>";
    echo "<td>".$bug->getCreated()->format('d.m.Y')."</td>";
    echo "<td> Produit(s) : ";
    foreach ($bug->getProducts() as $product) {
        echo "- ".$product->getName()." ";
    }
    echo "</td>";
    echo "<td>".$bug->getDescription()."</td>";
    echo "</tr>";
}
?>
    </table>
</div>

<div id="liste_tickets">
    <h2>Tickets fermés</h2>
    <?php
    foreach ($bugs_fermes as $bug) {
        if ($bug->getEngineer() != null){
            $engineer = $bug->getEngineer()->getName();
        }else{
            $engineer = "non affecté";
        }
        echo "<ul>";
        echo "<li><img src='./images/ferme.png' width='30px' height='30px'/></li>";
        echo "<li>".$bug->getCreated()->format('d.m.Y')."</li>";
        echo "<li> affecté à : ".$engineer."</li>";
        echo "<li> Produit(s) : ";
        foreach ($bug->getProducts() as $product) {
            echo "- ".$product->getName()." ";
        }
        echo "</li>";
        echo "<li>".$bug->getDescription()."</li>";
        echo "</ul>";
    }
    ?>
</div>