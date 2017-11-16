<?php
function formatVerification(){
    if(isset($_GET['num'])) {
        $num = $_GET['num'];
        $pattern = array();
        $pattern[0] = '/\d*?\./';
        $replacement = array();
        $replacement[0] = '';
        $num = preg_replace($pattern, $replacement, $num);
        $num = shell_exec('look ' . $num . ' list.txt');
        echo $num;

        return true;
        // valider le format ????
    }
    else{
        return false;
        // envoyer message d'erreur ???
    }
}