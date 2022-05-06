<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('error_reporting', E_ALL);

echo "from imahe" ;

$url = $_GET['url'];
$imgrnd = $_GET['imgrnd'];
$forered = $_GET['forered'];
$foregreen = $_GET['foregreen'];
$foreblue = $_GET['foreblue'];
$backred = $_GET['backred'];
$backgreen = $_GET['backgreen'];
$backblue = $_GET['backblue'];

showPNG($url, $imgrnd, $forered,$foregreen,$foreblue,$backred,$backgreen,$backblue);
$directory = "images/";
if (glob($directory . "*.png") != false)
{
 $filecount = count(glob($directory . "*.png"));
 echo "<code>" . $filecount . "</code> QR images have been generated using our QR System and counting ...";
}


Function showPNG($filename, $imgrnd, $my_forered, $my_foregreen, $my_foreblue,  $my_backred, $my_backgreen, $my_backblue )
{		

$png = imagecreatefrompng($filename);
imagetruecolortopalette($png, false, 255);
imagecolorset($png, 0, $my_forered, $my_foregreen, $my_foreblue);
imagecolorset($png, 1, $my_backred, $my_backgreen, $my_backblue);
$dest = 'images/' . $imgrnd . '.png' ;
imagepng($png, $dest);
imagedestroy($png);


// create jpg image
$jpg = 'images/' .  $imgrnd . ".jpg";
$quality = 90 ; // image quality
png2jpg($dest, $jpg, $quality) ;

// create gif image
$gif = 'images/' .  $imgrnd . '.gif' ;
png2gif($dest, $gif) ;

}
 

function png2jpg($originalFile, $outputFile, $quality) {
    $image = imagecreatefrompng($originalFile);
    imagejpeg($image, $outputFile, $quality); // Save the image as a JPG
    imagedestroy($image);
}

function png2gif($originalFile, $outputFile) {
    $image = imagecreatefrompng($originalFile);
    imagegif($image , $outputFile);  // Save the image as a GIF
    imagedestroy($image);
}


?>