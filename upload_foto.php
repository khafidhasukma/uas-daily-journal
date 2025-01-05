<?php 
function upload_foto($File){
    $uploadOk = 1;
    $hasil = array();
    $message = '';
 
    //File properties:
    $fileName = $File['name'];
    $tmpLocation = $File['tmp_name'];
    $fileSize = $File['size'];

    //Figure out what kind of file this is:
    $fileExt = explode('.', $fileName);
    $fileExt = strtolower(end($fileExt));

    //allowed files:
    $allowed = array('jpg', 'png', 'gif', 'jpeg', 'webp', 'svg');

    // Check file size
    if ($fileSize > 2000000) { // 2MB in bytes
        $message .= "Sorry, your file is too large, max 2MB. ";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if(!in_array($fileExt, $allowed)){
        $message .= "Sorry, only JPG, JPEG, PNG, GIF, WEBP & SVG files are allowed. ";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message .= "Sorry, your file was not uploaded. ";
        $hasil['status'] = false;
        // if everything is ok, try to upload file
    }else{
        //Create new fileName:
        $newName = date("YmdHis"). '.' . $fileExt;
        $uploadDestination = "img/". $newName;

        if (move_uploaded_file($tmpLocation, $uploadDestination)) {
            //echo "The file has been uploaded.";
            $message .= $newName;
            $hasil['status'] = true;
        }else{
            $message .= "Sorry, there was an error uploading your file. ";
            $hasil['status'] = false;
        }
    }
    
    $hasil['message'] = $message;
    return $hasil;
}
?>