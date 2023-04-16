<?php

    if(array_key_exists("submit", $_GET)) {
        $rows = $_GET["rows"];
        $cols = $_GET["cols"];
    }

    if (isset($rows) && isset($cols)) {
        if (!is_numeric($rows) or !is_numeric($cols)) {
            $rows = null;
            $cols = null;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Úkol Formulář malá násobilka</title>
    <style>td {text-align: center}</style>
</head>
<body>
    <h1>Úkol Formulář malá násobilka</h1>

    <form action="" method="get">
        <label for="radky">Zadejte počet řádků:</label>
        <input type="text" name="rows" id="radky">
        <label for="sloupce">Zadejte počet sloupců:</label>
        <input type="text" name="cols" id="sloupce">
        <input type="submit" name="submit" value="Vytvořit tabulku">
        <hr />
    </form>

    <?php

        if (isset($rows) && isset($cols)) {
                    //zde echujeme začátek tabulky
        echo "<table border = '1' cellspacing = '0' cellpadding = '5'>";

        //cyklus pro řádky
        for ($row = 1; $row <= $rows; $row++) {
            echo "<tr>";
            //cyklus pro sloupce
            for ($column = 1; $column <= $cols; $column++) {
                //první sloupec nebo řádek tučně
                if ($row == 1 || $column == 1) {
                    echo "<td><b>".($row*$column)."</b></td>";
                } else {
                    echo "<td>".($row*$column)."</td>";
                }
            }      
            echo "</tr>";
        }

        echo "</table>";

        }


    ?>
    
</body>
</html>