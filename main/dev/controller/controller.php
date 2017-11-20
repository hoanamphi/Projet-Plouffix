<?php
require_once('../views/lookup.twig');
//Formalise la string ressu et renvoit une string formalisé (contient uniquement des int, sans virgule) ou renvoit un message d'erreur sur la views
  function inputFormatisation(){
      if(isset($_GET['num'])) {
          $num = $_GET['num'];
          //fait le test pour savoir si la string contient autre chose que des 0.xxx, .xxx ou xxx
          if (preg_match('/0|\.|\d*?/', $num)) {
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

        $num = shell_exec('look '. $num .' list.txt');
    }

    //recherche le reperdoire dans le quel se trouve le txt contenant le numéro donné par inputFormatisation
    function rechercheRepertoire() {
        // fait appel à input formatisation ????

    }

    // retourne le résultat trouvé par rechercheNum, sinon soit ne fait rien, soit renvoit un message d'erreur si la chaîne est vraiment non formlisable
    function returningList()
    {

        if (inputFormatisation() != null) {

        }
    }
