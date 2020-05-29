<?php
session_start();
include_once("DBController.php");
$db = new DBController();
$data = $db->readData();
$fileName = "data.csv";
$filePointer = fopen($fileName, "w");
foreach ($data as $dataRow) {
    fputcsv($filePointer, $dataRow);
}
fclose($filePointer);
if (file_exists($fileName)) {
    header('Content-Description: File Transfer');
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fileName));
    echo "\xEF\xBB\xBF"; // UTF-8 BOM string
    readfile($fileName);
    exit;
}