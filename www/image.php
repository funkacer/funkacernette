<?php
    header ("Content-type: image/jpg");
///// Create the image ////////
$im = @ImageCreate (100,100)
or die ("Cannot Initialize new GD image stream");

$background_color = ImageColorAllocate ($im, 204, 204, 204); // Assign background color
$text_color = ImageColorAllocate ($im, 51, 51, 255);      // text color is given 

ImageString($im,5,10,10,'PLUS2NET',$text_color); // Random string  from session added 


imageline ($im,0,0,100,100,$text_color);

ImageJpeg ($im); // image displayed
imagedestroy($im); // Memory allocation for the image is removed. 

    /*
    if (extension_loaded('gd')) {
        echo "<br>GD support is  loaded ";
        }else{
        echo "<br>GD support is NOT loaded ";
        }
        if(function_exists('gd_info')){
        echo "<br>GD function support is available ";
        }else{
        echo "<br>GD function support is NOT available ";
    }

    $im = @ImageCreate (1000, 1000);

    $background_color = ImageColorAllocate ($im, 234, 234, 234);

    $text_color = ImageColorAllocate ($im, 233, 14, 91);

    $x1 = 0;
    $x2 = 0;
    $y1 = 1000;
    $y2 = 1000;
    imageline ($im,$x1,$y1,$x2,$y2,$text_color);

    ImagePng ($im);
    */

?>