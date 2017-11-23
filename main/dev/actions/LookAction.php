<?php
namespace Dev\Actions;

use Dev\Model;

class LookAction {

    private $model;

    public function __construct() {
        $this->model = new Model\ModelLook();
    }

    public function inputFormatisation($num){
            //fait le test pour savoir si la string contient autre chose que des 0.xxx, .xxx ou xxx
            if (preg_match('/^((\d?(,|\.))?)(\d{6,41})$/', $num)) {
                //moyens de simplifier en virant des variables ici
                $num = preg_replace('/\.|,/', '', $num);
                return $num;
            } else {
                //appelle à la fonction qui affiche le message d'erreur
                return "erreur, veuilliez rentrer un nombre compris entre 6 et 41 digits tel que : soit 0.xxx ou .xxx ou xxx";
            }
    }

    public function returnData($num) {
        $path = $this->model->findFile($num);
        $data = $this->model->findResult($path, $num);
        return $data;
    }

}