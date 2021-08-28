<?php
// Load dbconfig file
include_once 'dbConfig.php';

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CsvToDb</title>
</head>
<body>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit"> UPLOAD </button>
</form>
<form action="get.php" method="GET">
    <button type="getStatus" name="getStatus"> by Status </button>
    <button type="getCurrency" name="getCurrency"> by Currency </button>
</form>
</body>
</html>