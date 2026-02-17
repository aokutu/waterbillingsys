<?php 
$file_path = 'data.csv';

// Check if the file exists
if (file_exists($file_path)) {
    // Set headers to force download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Length: ' . filesize($file_path));

    // Read the file and output its contents
    readfile($file_path);}

?>