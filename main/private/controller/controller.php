<?php
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
    }
}