<?php
// Load dbconfig file
include_once 'dbConfig.php';

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];     // Get all information from input 'file'
    print_r($file);
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileBaseName = substr($fileName, 0, strripos($fileName, '.'));

    $fileExt = explode('.', $fileName);
    $fileAcExt = strtolower(end($fileExt));

    $allowed = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 
    'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 
    'application/vnd.msexcel', 'text/plain');
    $num = 1;

    // Validate whether selected file is a CSV file
    if (!empty($fileName) && in_array($fileType, $allowed)) {
        if ($fileError === 0) { // Check error for log
            if ($fileSize < 1000000) {
                if (is_uploaded_file($fileTmp)) {
                    // Open uploaded CSV file in read-only
                    $csvFile = fopen($fileTmp, 'r');
                    fgetcsv($csvFile);  // Skip the first line

                    // data parsing line by line
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        // Get row data
                        $transaction_id = $line[0];
                        $amount         = $line[1];
                        $currency_code  = $line[2];
                        $date           = $line[3];
                        $status         = $line[4];
                    
                    // Check whether transaction already exists in the db
                    $prevQuery = "SELECT id FROM transactions WHERE transaction_id = '".$line[0]."'";
                    $prevResult = $db->query($prevQuery);

                    if($prevResult->num_rows > 0){
                        // Update data in the db
                        $db->query("UPDATE transactions SET amount = '".$amount."', currency_code = '".$currency_code."', date = '".$date."', status = '".$status."'");
                    }else{
                        // Insert data in the db
                        $db->query("INSERT INTO transactions (transaction_id, amount, currency_code, date, status) VALUES ('".$transaction_id."', '".$amount."', '".$currency_code."', '".$date."','".$status."')");
                    }
                    
                    while (file_exists("uploads/" . $fileTmp . "." . $fileAcExt)) { // prevent overwrite
                        $fileNameTmp = (string) $fileName . $num;
                        $fileName = $fileName . "." . $fileAcExt;
                        $num++;
                    }
                    // $fileNameNew = $fileBaseName.".".$fileAcExt;        
                    $filePath = 'uploads/'.$fileName;
                    move_uploaded_file($fileTmp, $filePath);
                    }
                    // Close opened CSV file
                    fclose($csvFile);

                    $qstring = '?status=succ';
                }else {
                    $qstring = '?status=err';
                    echo "Logging Unknown Format file size";
                }
            }else {
                echo "Logging Unknown Format all error";    // logging code
            }
        }else {
            echo "Unknown Format";
        }
    }else {
        $qstring = '?status=invalid_file';
    }
}

// Redirect page
header("Location: index.php".$qstring);
?>