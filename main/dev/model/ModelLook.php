<?php
namespace Dev\Model;

class ModelLook {

    public function findFile($num) {
        $path =  INC_ROOT . "/dev/model/".$num[0]."/a".$num[0].$num[1].$num[2].$num[3].'.txt';
        return $path;
    }

    public function findResult($num) {
        $path = $this->findFile($num);
        if(file_exists($path)) {
            $data = file($path) or die("could not open the file");
            return $data;
        }
        return false;
    }

}