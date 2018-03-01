<?php
namespace Dev\Action;

use Dev\Model;
use Exception;

class LookAction {

    private $model;

    public function __construct() {
        $this->model = new Model\ModelLook();
    }

    public function returnData($num) {
        if ($num != false) {
//            $data = $this->model->findResult($num);
//            $higIndex = count($data)-1;
//            $data = $this->binary_search($data, $num, 0, $higIndex, 0);
            $data = $this->model->look($num);
            return $data;
        }
        throw new Exception("Non valid argument");
    }

    //fonction récursive qui prend en paramètre le tableau sur le quel rechercher, le nombre rechercher, l'index de la première ligne, l'index de la dernière ligne
    function binary_search($data, $num, $lowIndex, $higIndex, $iteration) {

        $tmpLowIndex = $lowIndex;
        $tmpHigIndex = $higIndex;
        $lenNum = strlen($num);

        $midIndex = intdiv(($lowIndex + $higIndex), 2);
        $midVal = preg_replace('/0?(\.|,)/','', $data[$midIndex]);
        $midVal = substr($midVal, 0, $lenNum);

        if ($midVal == $num) {
            $lowVal = preg_replace('/0?(\.|,)/','', $data[$lowIndex]);
            $lowVal = substr($lowVal, 0, $lenNum);

            $higVal = preg_replace('/0?(\.|,)/','', $data[$higIndex]);
            $higVal = substr($higVal, 0, $lenNum);

            //permet de tonquer les valeurs non intéressantes du sous-tableau obtenus
            while ($lowVal != $num) {
                $lowIndex++;
                $lowVal = preg_replace('/0?(\.|,)/','', $data[$lowIndex]);
                $lowVal = substr($lowVal, 0, $lenNum);
            }
            //permet de tronquer les valeurs non intéressantes du sous-tableau obtenus
            while ($higVal != $num) {
                $higIndex--;
                $higVal = preg_replace('/0?(\.|,)/','', $data[$higIndex]);
                $higVal = substr($higVal, 0, $lenNum);
            }
            $higIndex = $higIndex-$lowIndex;
            $data = array_slice($data, $lowIndex, $higIndex+1);
            return $data;

        } else {

            if ($num > $midVal) {
                $lowIndex = $midIndex;

            } else {
                $higIndex = $midIndex;
            }

            if ($tmpHigIndex == $higIndex && $tmpLowIndex == $lowIndex) {
                $iteration++;
                if ($iteration > 3) {
                    throw new Exception('too mutch iterations');
                }
            }
            return $this->binary_search($data, $num, $lowIndex, $higIndex, $iteration);
        }

    }

}