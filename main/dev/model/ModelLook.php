<?php
namespace Dev\Model;

use Exception;

class ModelLook {

    public function findFile($num) {
        //Modifier la partie gauuche du chemin vers la zone contenant les fichiers
        // ici, la partie droite avec les num étant faite our trouver le fichier a0000.txt
        $path =  "../Dev/Model/".$num[0]."/a".$num[0].$num[1].$num[2].$num[3].'.txt';
        return $path;
    }

    public function findResult($num) {
        $path = $this->findFile($num);
        if(file_exists($path)) {
            $data = file($path);
            return $data;
        }
        throw new Exception("File doesn't exist");
    }

    public function look($num) {
        $path = $this->findFile($num);
            if(file_exists($path)) {
                exec("look " . $num . " " . $path, $data);
                return $data;
            }
        throw new Exception("File doesn't exist");
    }

}