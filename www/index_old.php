<?php
    require_once "data.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunKačer</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="funkacer">
        <ul>
            <?php
                $poleObrazku = scandir("./img/");
                foreach($poleObrazku AS $obrazek) {
                    if ($obrazek != "." && $obrazek != ".." && substr($obrazek, strlen($obrazek)-4, 4) == ".png") {
                        if (substr($obrazek, 0, 2) == "01" || substr($obrazek, 0, 2) == "04" || substr($obrazek, 0, 2) == "07" || substr($obrazek, 0, 2) == "09" || substr($obrazek, 0, 2) == "12") {
                            echo "<li>";
                        }
                        echo "<img class = 'pismeno' src='./img/{$obrazek}' height = '150px' alt='pismeno'>";
                        //echo "$obrazek";
                        if (substr($obrazek, 0, 2) == "03" || substr($obrazek, 0, 2) == "06" || substr($obrazek, 0, 2) == "08" || substr($obrazek, 0, 2) == "11" || substr($obrazek, 0, 2) == "13") {
                            echo "</li>";
                        }
                    }
                }
            ?>
        </ul>
    </div>

    <div class="container">
        <div class="hello">
            <h1>
                <ul>
                    <li>Fun</li>
                    <li>Kačerujte!</li>
                </ul>
            </h1>

            <h2>
                <ul>
                    <li>Toto jsou mé testovací stránky.</li>
                    <li>Kam chcete jít?</li>
                </ul>
            </h2>

        </div>
    </div>

    <div class="menu">
        <ul>
            <?php
                foreach ($poleThumbnails AS $id => $Thumbnail) {
                    echo "<li>";
                    echo "<a href='{$Thumbnail->getReference()}' target = 'blank'>";
                    echo "<strong>{$Thumbnail->getMenu()}</strong>";
                    echo "<br />";
                    $picturePath = "./upload/".$Thumbnail->getPicture();
                    echo "<img src='$picturePath' height = '100px' width = '200px' alt='picture'>";
                    echo "</a>";
                    echo "</li>";
                }
            ?>
        </ul>
    </div>

    <script src="./js/main.js"></script>
    
</body>
</html>