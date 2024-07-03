<?php
    if (array_key_exists("email-submit", $_POST)) {
        $odesilatel = $_POST["odesilatel"];
        $adresat = $_POST["adresat"];
        $predmet = $_POST["predmet"];
        $zprava = $_POST["zprava"];

        mb_send_mail($adresat, $predmet, $zprava, ["From" => "Já <cerny.home@seznam.cz>"]);

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emaily</title>
</head>
<body>
    <h1>Emaily</h1>

    <form action="" method="post">
        <label for="aa">Osesílatel</label>
        <input type="text" name="odesilatel" id="aa">
        <br><br>
        <label for="a">Adresát</label>
        <input type="text" name="adresat" id="a">
        <br><br>
        <label for="p">Předmět</label>
        <input type="text" name="predmet" id="p">
        <br><br>
        <label for="z">Zpráva</label>
        <textarea name="zprava" id="z"></textarea>
        <br><br>
        <input type="submit" name="email-submit" value="Odeslat">
    </form>
</body>
</html>