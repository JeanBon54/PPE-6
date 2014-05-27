<?php
function envoieFichier($file)
{
    $fichier = basename($file['name']);
    $nb_min = 1;
    $nb_max = 1000;
    $nombre = mt_rand($nb_min,$nb_max);
    //$fichier = $nombre;

    $taille_maxi = 9000000;
    $taille = filesize($file['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg' );
    $extension = strrchr($file['name'], '.');
    $fichier = $nombre.$extension;
    //Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = '<br>Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
    }
    if($taille>$taille_maxi)
    {
        $erreur = '<br>Le fichier est trop gros...';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {

        if(move_uploaded_file($file['tmp_name'], "../upload/". $fichier))
            //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            echo "</br>Le fichier a bien été envoyé";
            // echo var_dump($fichier);
            return $fichier;
        }
        else //Sinon (la fonction renvoie FALSE).
        {
            echo '<br>Echec de l\'upload !';
            return false;
        }
    }
    else
        echo $erreur;
}
