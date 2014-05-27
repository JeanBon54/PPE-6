<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Eric
 * Date: 20/02/14
 * Time: 19:17
 * To change this template use File | Settings | File Templates.
 */

include("vues/v_entete.php") ;
include("vues/v_bandeau_tech.php") ;
echo("Bienvenue ".$_SESSION['login']['identite']);?></br><?php

if(!isset($_REQUEST['action']))
    $action = 'list';
else
    $action = $_REQUEST['action'];

switch($action){
    case 'list':{
        $tech = $_SESSION['login']['id'];
        $the_bugs = getBugsTech($tech);
        $bugs_en_cours = $the_bugs[0];
        $bugs_fermes =  $the_bugs[1];
        include ("vues/v_container_tab_tech.php");
        break;
    }
    case 'config' : {
        $techniciens = getAllTechnicien();
        include("vues/v_config_tech.php");
        break;
    }
    case 'modifier_statut' : {
        $idBug = $_POST['idBug'];
        $idEngineer = $_SESSION['login']['id'];
        $status = $_POST['statut'];
        $resume = $_POST['resume'];
        statutBug($idBug, $idEngineer, $status, $resume);
        header("Location:index.php?uc=dash");
        break;
    }
    case 'modifier_statut' : {

    }
    case 'test':{

        break;
    }
}