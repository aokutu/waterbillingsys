<?php
 require_once 'backup/vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$html = '<table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            <tr>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>1234567890</td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>jane@example.com</td>
                <td>0987654321</td>
            </tr>
        </table>';
        // Load the HTML content into Dompdf
$dompdf->loadHtml($html);

// (Optional) Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML content to PDF
$dompdf->render();

// Output the PDF as a file (you can also use 'inline' to show the PDF in the browser)
$dompdf->stream('output.pdf', ['Attachment' => true]);
?>
