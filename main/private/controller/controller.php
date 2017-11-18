<?php
require_once('../view/lookup.php');
//Formalise la string ressu et renvoit une string formalisé (contient uniquement des int, sans virgule) ou renvoit un message d'erreur sur la view
    function inputFormatisation(){
        if(isset($_GET['num'])) {
            $num = $_GET['num'];
            //fait le test pour savoir si la string contient autre chose que des 0.xxx, .xxx ou xxx
            if (preg_match('/0?(\.|,)?\d{6,41}/', $num)) {
                $pattern = array();
                $pattern[0] = '/\d*?\.|,/';
                $replacement = array();
                $replacement[0] = '';
                //moyens de simplifier en virant des variables ici
                $num = preg_replace($pattern, $replacement, $num);
                return $num;
            } else {
                //appelle à la fonction qui affiche le message d'erreur
                return false;
            }
        } else {
            //ne fait rien puisque l'utilisateur n'a encore rien rentré
            return null;
        }
    }

    //recherche le numéro dans le txt donné par rechercheRepertoire
    function rechercheNum() {
        /*$path = rechercheRepertoire();
        $num = shell_exec('look '.$path);
        return $num;*/
    }

    //recherche le reperdoire dans le quel se trouve le txt contenant le numéro donné par inputFormatisation
    function rechercheRepertoire(/*$num*/) {
        /* $path= $num." "
         * if($num[0] = 1){
            $path = "model/1"
            if(num[1] = 0 && num[2] = 0 && num[3]){
                $path = $path."/a1000.txt"
        */
    }

    // retourne le résultat trouvé par rechercheNum, sinon soit ne fait rien, soit renvoit un message d'erreur si la chaîne est vraiment non formlisable
    function returningList()
    {

        /*if (inputFormatisation() != null) {

        }*/
    }