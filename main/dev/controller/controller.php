<?php
require_once('../view/lookup.php');

$entree = $_GET['num'];

//Formalise la string reçue et renvoit une string formalisé (contient uniquement des int, sans virgule) ou renvoit un message d'erreur sur la view
    function inputFormatisation(){
        global $entree;

        if(isset($entree)) {
            //fait le test pour savoir si la string contient autre chose que des 0.xxx, .xxx ou xxx
            if (preg_match('/0?(\.|,)?\d{6,41}/', $entree)) {
                $pattern = array();
                $pattern[0] = '/\d*?\.|,/';
                $replacement = array();
                $replacement[0] = '';
                //moyens de simplifier en virant des variables ici
                $num = preg_replace($pattern, $replacement, $entree);
                return $num;
            } else {
                //appelle à la fonction qui affiche le message d'erreur
                return null;
            }
        } else {
            //ne fait rien puisque l'utilisateur n'a encore rien rentré
            return null;
        }
    }

    //recherche le numéro dans le txt donné par rechercheRepertoire
    function rechercheNum($num) {
        $path = rechercheRepertoire($num);
        $res = shell_exec('look '.$num." ".$path);
        return $res;
    }

    //recherche le reperdoire dans le quel se trouve le txt contenant le numéro donné par inputFormatisation
    function rechercheRepertoire($num) {
        $path = "../model";
        $path = $path."/".$num[0];
        $path = $path."/a".$num[0-3].".txt";
        return $path;
    }

    // retourne le résultat trouvé par rechercheNum, sinon soit ne fait rien, soit renvoit un message d'erreur si la chaîne est vraiment non formlisable
    function returningList()
    {
        $num =  inputFormatisation();
        if($num != null){
            $res = rechercheNum($num);
            //afficher le résultat
        }
        else{
            //message d'erreur
        }
    }
?>