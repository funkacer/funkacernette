<?php

    if (array_key_exists("kontakt-submit", $_POST)) {
        //echo "OK";
        $jmeno = $_POST["jmeno"];
        $prijmeni = $_POST["prijmeni"];
        $email = $_POST["email"];
        $vzkaz = $_POST["vzkaz"];

        $kontakt = new Kontakt(null, $jmeno, $prijmeni, $email, $vzkaz);
        $kontakt->ulozDoDb();
        //var_dump($kontakt);

        //toto při úspěšném odeslání
        echo "<script>
            let elmFeedback = document.querySelector('#feedback');
            elmFeedback.innerHTML = 'Děkujeme za vzkaz, budeme Vás kontaktovat.<br />Váš Prima Penzion.';
        </script>";
        
        /*
        echo "<p style = 'color: red; font-size: 4em; text-align: center'>Děkujeme za vzkaz, budeme Vás kontaktovat.</p>";
        */
        
    }
    
?>

<script>

    //nejprve zaměřit všechny odkazy
    let elmOdkazSmazat = document.querySelector("#submit-button");

    //musíme každý odkaz deaktivovat
    elmOdkazSmazat.addEventListener("click", (e) => {
        //vypnuli jsme přesměrování na ?smazat=$instance v php odkazech simulujících getovský formulář
        
        //confirm je dialogové okno pro potvrzení nebo zrušení
        //vrací boolean (true = OK, false = Cancel)
        let souhlas = confirm("Opravdu chcete odeslat vzkaz?");
        if (souhlas == true) {
            //musíme zjistit, kam původní odkaz směřoval
            //let cilOdkazu = odkaz.getAttribute("href");
            //přesměrujeme uživatele
            //window.location.href = cilOdkazu;
        } else {
            e.preventDefault();
        }
    })
</script>