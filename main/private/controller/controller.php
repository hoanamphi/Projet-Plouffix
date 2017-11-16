<?php
<<<<<<< HEAD
//Formalise la string ressu et renvoit une string formalisé (contient uniquement des int, sans virgule) ou renvoit un message d'erreur sur la view
  function inputFormatisation(){
      if(isset($_GET['num'])) {
          $num = $_GET['num'];
          $pattern = array();
          $pattern[0] = '/\d*?\./';
          $replacement = array();
          $replacement[0] = '';
          $num = preg_replace($pattern, $replacement, $num);
          $num = shell_exec('look ' . $num . ' list.txt');
          return $num;
      } else{
          return null;
        }
      }

    //recherche le numéro dans le txt donné par rechercheRepertoire
    function rechercheNum() {

    }

    //recherche le reperdoire dans le quel se trouve le txt contenant le numéro donné par inputFormatisation
    function rechercheRepertoire() {

    }

    // retourne le résultat trouvé par rechercheNum, sinon soit ne fait rien, soit renvoit un message d'erreur si la chaîne est vraiment non formlisable
    function returningList() {

      if (inputFormatisation() != null) {

      }

=======
function formatVerification($num){
    if(isset($num)) {
        if(strlen($num) >= 6){
            if(preg_match("[0-9]*(.|,)*[0-9]*", $num)){
                $pattern = array();
                $pattern[0] = '/\d*?\./';
                $replacement = array();
                $replacement[0] = '';
                $num = preg_replace($pattern, $replacement, $num);
                return $num;
                //$num = shell_exec('look ' . $num . ' list.txt');
            }
            else{
                return null;
                // pas le droit d'entrer de caractères
            }
        }
        else{
            return null;
            // dire de rajouter des décimales
        }
    }
    else{
        return null;
        // envoyer message d'erreur ???
>>>>>>> e91018fa9998405de33919a5961d1c799068d5a1
    }
}
