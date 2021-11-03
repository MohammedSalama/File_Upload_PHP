<?php

if(isset($_POST['submit'])){
    $imgs = $_FILES ['imgs'];

    // echo "<pre>";
    // print_r($imgs);
    // echo "</pre>";

    $imgNames = $imgs['name'];
    $imgTypes = $imgs['type'];
    $imgTmpNames = $imgs['tmp_name'];
    $imgErrors = $imgs['error'];
    $imgSizes = $imgs['size'];

    $imgCount = count($imgNames);
    $allowedExtensions = ['jpg' , 'png' , 'jpeg' , 'gif','zip'];

    for ($i =0; $i < $imgCount; $i++){
        $randomStr = uniqid();
        $imgExtension = pathinfo($imgNames[$i], PATHINFO_EXTENSION);

        //upload successfully , Extensions , Size
        $imgSizeMb = $imgSizes[$i] / (1024 ** 2);

        if($imgErrors[$i] != 0){
            echo "Error While Uploading Image";
        }elseif(in_array($imgExtension , $allowedExtensions) == false){
            echo "Extension Is Not Valid , allowed is jpg , jpeg , png , gif";
         }
        elseif($imgSizeMb > 2){
            echo "Maximum Allowed Size = 2Mb";

        }
        else {
            $imgNewName = "$randomStr . $imgExtension";
            move_uploaded_file($imgTmpNames[$i] , "Uploads/$imgNewName");

        }
    }
}
?>