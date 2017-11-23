<?php
namespace Dev\Actions;

class LookAction {

    public function afficher() {
        return "test du controler";
    }

    public function inputFormatisation($num){
            //fait le test pour savoir si la string contient autre chose que des 0.xxx, .xxx ou xxx
            if (preg_match('/^(\d?(,|\.))(\d{6,41})$/', $num)) {
                //moyens de simplifier en virant des variables ici
                $num = preg_replace('/\d*?\.|,/', '', $num);
                return $num;
            } else {
                //appelle à la fonction qui affiche le message d'erreur
                return "erreur, veuilliez rentrer un nombre compris entre 6 et 41 digits tel que : soit 0.xxx ou .xxx ou xxx";
            }
    }

    public function isNumber(string $str): bool{
        return is_numeric($str);
    }

    public function strToFloat(string $str): float{
        return ($str+0);
    }
}