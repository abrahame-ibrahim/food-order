<?php
// Include FPDF library
require('fpdf/fpdf.php');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'food-fusion');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch order data
$sql = "SELECT * FROM tbl_order ORDER BY order_date DESC";
$result = $conn->query($sql);

// Create PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Add header
$pdf->Cell(190, 10, 'Order Report', 1, 1, 'C');

// Add table headings
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'Order ID', 1);
$pdf->Cell(40, 10, 'Food', 1);
$pdf->Cell(20, 10, 'Price', 1);
$pdf->Cell(20, 10, 'Qty', 1);
$pdf->Cell(25, 10, 'Total', 1);
$pdf->Cell(30, 10, 'Order Date', 1);
$pdf->Cell(35, 10, 'Status', 1);
$pdf->Ln();

// Add data to table
$pdf->SetFont('Arial', '', 10);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 10, $row['id'], 1);
        $pdf->Cell(40, 10, $row['food'], 1);
        $pdf->Cell(20, 10, number_format($row['price'], 2), 1);
        $pdf->Cell(20, 10, $row['qty'], 1);
        $pdf->Cell(25, 10, number_format($row['total'], 2), 1);
        $pdf->Cell(30, 10, $row['order_date'], 1);
        $pdf->Cell(35, 10, $row['status'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(190, 10, 'No orders found.', 1, 1, 'C');
}

// Output PDF
$pdf->Output('D', 'Order_Report.pdf');

// Close database connection
$conn->close();
?>
