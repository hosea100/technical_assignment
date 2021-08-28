<?php
// Load dbconfig file
include_once 'dbConfig.php';

$query = "SELECT * FROM transactions;";
$getCurrency = "SELECT * FROM transactions ORDER BY currency_code;";
$getStatus = "SELECT * FROM transactions ORDER BY status;";
$result = mysqli_query($db, $query);
$resCurrency = mysqli_query($db, $getCurrency);
$resStatus = mysqli_query($db, $getStatus);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    if (isset($_GET['getStatus'])) {
        while ($row = mysqli_fetch_assoc($resStatus)) {
            echo json_encode($row)."\n";
        }
    }elseif (isset($_GET['getCurrency'])) {
        while ($row = mysqli_fetch_assoc($resCurrency)) {
            echo json_encode($row)."\n";
        }
    }
}