<?php

    function spocitejObvod ($argPolomer) {

        return 2 * pi() * $argPolomer;

    }

    function spocitejObsah ($argPolomer) {

        // na druhou
        return pi() * pow($argPolomer, 2);
    }

    function cNaF ($argCelsius) {
        //Divide by 5, then multiply by 9, then add 32
        $resultFahrnheit = $argCelsius / 5 * 9 + 32;
        return $resultFahrnheit;
    }

    function fNaC ($argFahrenheit) {
        //Deduct 32, then multiply by 5, then divide by 9
        $resultCelsius = ($argFahrenheit - 32) * 5 / 9;
        return $resultCelsius;
    }


?>