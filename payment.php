<?php
try {
    // Prepare the SQL statement to insert payment details including the status
    $sql = "INSERT INTO payments (amount, phone, status) 
            VALUES (:amount, :phone, :status)";
    
    // Prepare the statement
    $stmt = $pdo->prepare($sql);
    
    // Bind values to the statement
    $stmt->execute([
        ':amount' => $_POST['amount'],
        ':phone' => $_POST['phone'],
        ':status' => 'completed' // Set the status to 'completed' or 'pending' as needed
    ]);
    
    echo "Payment details saved successfully.";
} catch (PDOException $e) {
    echo "Error saving payment details: " . $e->getMessage();
}
?>
