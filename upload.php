<?php
if (isset($POST['submit'])) {
    $file = $_FILES['file'];     # Get all information from input 'file'
    print_r($file);
    $fileName = $file['name'];
    // $fileTmp = $file['tmp_name'];
    // $fileSize = $file['size'];
    // $fileError = $file['error'];
    // $fileType = $file['type'];

    // $fileExt = explode('.', $fileName);
    // $fileAcExt = strtolower(end($fileExt));

    // $allowed = array('csv', 'xml', 'jpg', 'jpeg');

    // if (in_array($fileAcExt, $allowed)) {       # Check wheter ext as $allowed or invalid
    //     if ($fileError === 0) {                 # Check error for log
    //         if ($fileSize < 1000) {
    //             $fileNameNew = uniqid('', true).".".$fileAcExt;        # prevent overwrite
    //             $filePath = 'uploads/'.$fileNameNew;
    //             move_uploaded_file($fileTmp, $filePath);
    //             header("Location: index.php?uploadsuccess");
    //         }else {
    //             echo "Logging Unknown Format file size";
    //         }
    //     }else {
    //         echo "Logging Unknown Format all error";      #logging code
    //     }
    // }else {
    //     echo "Unknown Format";
    // }
}
?>