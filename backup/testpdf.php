<?php
require_once 'vendor/autoload.php'; // Include Dompdf autoload file

use Dompdf\Dompdf;
use Dompdf\Options;

// Database connection configuration
$host = 'localhost';
$username = 'lawascoco';
$password = 'Lamuwater@24';
$database = 'lawascoco_Lawasco';

// Create a MySQL connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from MySQL
$sql = "SELECT * FROM accounts1 LIMIT 10 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start HTML content with table and styles
    $html = '<html><body>';
    $html .= '<style>';
    $html .= 'table { border-collapse: collapse; width: 100%; }';
    $html .= 'th, td { border: 1px solid black; padding: 8px; }';
    $html .= '</style>';
    $html .= '<h1>MySQL Data</h1>';
    $html .= '<table>';
    $html .= '<tr><th>Name</th><th>Email</th><th>Phone</th></tr>';

    // Output data of each row in table rows
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['account'] . '</td>';
        $html .= '<td>' . $row['name'] . '</td>';
        $html .= '<td>' . $row['id'] . '</td>';
        $html .= '</tr>';
    }

    // Close table and HTML content
    $html .= '</table>';
    $html .= '</body></html>';

    // Create PDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Output the PDF as a file (download)
    $dompdf->stream('mysql_data.pdf', array('Attachment' => 0));
} else {
    echo 'No data found.';
}

// Close MySQL connection
$conn->close();
?>
