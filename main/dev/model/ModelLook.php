<?php
namespace Dev\Model;

class ModelLook {

    public function findFile($num) {
        $path =  INC_ROOT . "/dev/model/".$num[0]."/a".$num[0].$num[1].$num[2].$num[3].'.txt';
        return $path;
    }

    public function findResult($path, $num) {
        if(file_exists($path)) {
            $open = fopen($path, "r");
            $data = fread($open, filesize($path));
            fclose($open);
            return $data;
        }
        return "erreur le fichier n'est pas disponible";
    }

}