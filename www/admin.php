<?php

    require_once "data.php";

    session_start();

    if(array_key_exists("login-submit", $_POST)) {
        $login = $_POST["login"];
        $password = $_POST["password"];
        if ($login == "admin" && $password == "papousek123") {
            $_SESSION["logged"] = true;
        }
    }

    if (array_key_exists("logged", $_SESSION)) {

        if(array_key_exists("unlog-submit", $_POST)) {
            unset($_SESSION["logged"]);
        }

        if(array_key_exists("upload-submit", $_POST)) {
            //get the name of the upload file
            $filename = $_FILES["file"]["name"];
            //echo $filename;

            //reference to ./upload location
            $location = "./upload/".$filename;

            //save to local filesystem
            $result = false;
            if ( move_uploaded_file($_FILES["file"]["tmp_name"], $location) ) {
                $result = true;
            }
        }

        if(array_key_exists("pictureSubmit", $_POST)) {
            $pictureName = $_POST["pictureName"];
            $_SESSION["picture"] = $pictureName;
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funkačer Admin</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Funkačer Admin</h1>
    
    <?php
        if (array_key_exists("logged", $_SESSION)) {
        ?>

            <br />
            <form action="" method="post"><input type="submit" name = "unlog-submit" value="Unlog"></form>
            <br />
            <form action="" method="post" enctype="multipart/form-data">
                <label for="file">Upload a site picture</label>
                <input type="file" name="file" id="file" />
                <input type="submit" name = "upload-submit" value="Upload">
            </form>

        <?php
        } else {
            ?>

                <form action="" method="post">
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login">
                    <label for="password">password</label>
                    <input type="password" name="password" id="password">
                    <input type="submit" name = "login-submit" value="Submit">
                </form>


            <?php
        }

        if (isset($result)) {
            if ($result) {
                echo "<p>File uploaded successfully.</p>";
            } else {
                echo "<p><b>Something went wrong!</b></p>";
            }
        }

        echo "<br />";

        if (array_key_exists("logged", $_SESSION)) {
            $poleUpload = scandir("./upload");
            echo "<select name='picture' id='picture'>";
            echo "<option value=''>Vyberte:</option>";
            foreach($poleUpload AS $picture) {
                if ($picture != "." && $picture != "..") {
                    echo "<option value='$picture'>$picture</option>";
                }
            }
            echo "</select>";
        }

        echo "<br /><br />";

        if (array_key_exists("picture", $_SESSION)) {
            $picturePath = "./upload/".$_SESSION["picture"];
            echo "<img src='$picturePath' height = '100px 'alt='picture'>";
        }

        // var_dump($_SESSION);
    ?>

    <br />
    <br />
    <hr />

    <!-- tady bude div se řádkama -->

    <div class="menu">
        <ul>
            <?php
                foreach ($poleThumbnails AS $id => $Thumbnail) {
                    echo "<li>";
                    echo "<strong>{$Thumbnail->getMenu()}</strong>";
                    echo "<br />";
                    $picturePath = "./upload/".$Thumbnail->getPicture();
                    echo "<img src='$picturePath' height = '50px' width = '100px' alt='picture'>";
                    echo "</li>";
                }
            ?>
        </ul>
    </div>

    <script src="./vendor/components/jquery/jquery.min.js"></script>

    <script src="./js/admin.js"></script>

</body>
</html>