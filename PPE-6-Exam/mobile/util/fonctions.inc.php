﻿<?php
/**
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * @param $codePostal : la chaîne testée
 * @return : vrai ou faux
*/
function estUnCp($codePostal)
{
   
   return strlen($codePostal)== 5 && estEntier($codePostal);
}
/**
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 * @param $valeur : la chaîne testée
 * @return : vrai ou faux
*/

function estEntier($valeur) 
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}
/**
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 * @param $mail : la chaîne testée
 * @return : vrai ou faux
*/
function estUnMail($mail)
{
return  preg_match ('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
}
/*
 * Fonction qui verifie si utilisateur est connecté
 * renvoie 1 si connecté
 * renvoie 0 si non connecté
 *
 */
function estConnecter(){
    $resu = 0;
    if(isset($_SESSION['login'])){
        $resu = 1;
    }
    return $resu;
}

/*
 * Déconnecte l'utilisateur
 */
function seDeconnecter(){
   unset($_SESSION['login']);
    echo'Vous avez été déconnecté';
}

/*
 * Fonction qui verifie si utilisateur est valide
 * reçoit le login et le mot de passe à vérifier.
 * La fonction s'occcupe de créer la variable session 'status' pour identifier le type d'utilisateur connecté
 * renvoie 1 si ok
 * renvoie 0 si non ok
 *
 */
function authentifierUser($l,$m){
    require "bootstrap.php";

    $dql = "SELECT u FROM User u WHERE u.login = '$l' AND u.mdp = '$m'";

    $query = $entityManager->createQuery($dql);
    $query->setMaxResults(1);
    $users = $query->getResult();

    if (count($users) > 0){
        $leClub = null;
        if ($users[0]->getLeClub() != null){
            $leClub = $users[0]->getLeClub()->getNumClub();
        }
        $log = array('id'=>$users[0]->getId(),'identite'=>$users[0]->getPrenom() . " " .$users[0]->getName(), 'fonction'=>$users[0]->getFonction(), 'club'=>$leClub );
        $_SESSION['login'] = $log;
        return 1;
    }else{
        return 0;
    }
}

function getBugsOpenByUser($id){
    require "bootstrap.php";
    $users = $entityManager->find('User', $id);
    $bugs = $users->getReportedBugs();
    $tab1 = array();
    $tab2 = array();
    foreach ($bugs as $bug) {
        if ($bug->getStatus() == "CLOSE"){
            $tab2[] = $bug;
        }else{
            $tab1[] = $bug;
        }
    }
    $retour = array($tab1, $tab2);
    return $retour;
}

function getBugsTech($id){
    require "bootstrap.php";
    $users = $entityManager->find('User', $id);
    $bugs = $users->getAssignedBugs();
    $tab1 = array();
    $tab2 = array();
    foreach ($bugs as $bug) {
        if ($bug->getStatus() == "CLOSE"){
            $tab2[] = $bug;
        }else{
            $tab1[] = $bug;
        }
    }
    $retour = array($tab1, $tab2);
    return $retour;
}

function getAllProducts(){
    require "bootstrap.php";
    $productRepository = $entityManager->getRepository('Product');
    $products = $productRepository->findAll();
    return $products;
}
function getAllTechnicien(){
    require "bootstrap.php";
    $techRepository = $entityManager->getRepository('User');
    $tech = $techRepository->findAll();
    $tab1 = array();
    foreach ($tech as $technicien) {
        if ($technicien->getFonction() == "Technicien"){
            $tab1[] = $technicien;
        }
    }
    $retour = $tab1;
    return $retour;
}
function getAllBugs(){
    require "bootstrap.php";
    $bugsRepository = $entityManager->getRepository('Bug');
    $bugs = $bugsRepository->findAll();
    $tab1 = array();
    $tab2 = array();
    foreach ($bugs as $bug) {
        if ($bug->getStatus() == "CLOSE"){
            $tab2[] = $bug;
        }else{
            $tab1[] = $bug;
        }
    }
    $retour = array($tab1, $tab2);
    return $retour;
}
function getOneBug($id) {
    require "bootstrap.php";
    //$dql = "SELECT b FROM Bug b WHERE b.id = '$id'";
    $bug = $entityManager->find('Bug', $id);
    //$query = $entityManager->createQuery($dql);
    //$bug = $query->getResult();
    return $bug;
}
function affecterBug($idBug, $idTech, $delai) {
    require "bootstrap.php";
    $bug = $entityManager->find('Bug', $idBug);
    echo var_dump($idBug);
    echo var_dump($bug);
    $tech = $entityManager->find('User', $idTech);
    $bug->setEngineer($tech);
    $bug->setDelai($delai);
    $entityManager->flush();
}
function statutBug($idBug, $idEngineer, $status, $resume) {
    require "bootstrap.php";
    $bug = $entityManager->find('Bug', $idBug);
    $engineer = $entityManager->find('User', $idEngineer);
    $bug->setEngineer($engineer);
    $bug->setStatus($status);
    $bug->setResume($resume);
    $entityManager->flush();
}
function ajouterNewBug(){
    $obj = $_POST['objet'];
    $lib = $_POST['libelle'];
    $apps = $_POST['apps'];
    //echo var_dump($_FILES);
    if($_FILES['file']['size'] != 0)
        $nomfichier = envoieFichier($_FILES['file']);

    require "bootstrap.php";

    $reporter = $entityManager->find("User", $_SESSION['login']['id']);
    //$engineer = new User();

    $bug = new Bug();
    $bug->setDescription($lib);
    $bug->setCreated(new DateTime("now"));
    $bug->setStatus("OPEN");
    $bug->setObjet($obj);
     if(isset($nomfichier))
     {
         if ($nomfichier != false)
             $bug->setcapture($nomfichier);
     }


    foreach ($apps as $productId) {
        $product = $entityManager->find("Product", $productId);
        $bug->assignToProduct($product);
    }

    $bug->setReporter($reporter);
    //$bug->setEngineer($engineer);

    $entityManager->persist($bug);
    $entityManager->flush();

}
?>