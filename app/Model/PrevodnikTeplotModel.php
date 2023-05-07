<?php

namespace App\Models;

use \Nette\Neon\Neon;
/**
 * Description of StatusModel
 *
 * @author garret
 */
final class PrevodnikTeplotModel {

    use \Nette\SmartObject;


    function __construct() {
        //$this->mail_config = $mail_config;
        //$this->flexibee = $flexibee;
    }

    public function cNaF ($argCelsius) {
        //Divide by 5, then multiply by 9, then add 32
        $resultFahrnheit = $argCelsius / 5 * 9 + 32;
        return $resultFahrnheit;
    }

    public function fNaC ($argFahrenheit) {
        //Deduct 32, then multiply by 5, then divide by 9
        $resultCelsius = ($argFahrenheit - 32) * 5 / 9;
        return $resultCelsius;
    }

}
