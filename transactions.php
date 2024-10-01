<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'mpesa_transactions');

// Fetch transaction data
$sql = "SELECT * FROM transactions ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='transaction'>";
        echo "<p>Transaction ID: " . $row['transaction_id'] . "</p>";
        echo "<p>Amount: " . $row['amount'] . "</p>";
        echo "<p>Status: " . $row['status'] . "</p>";
        echo "</div>";
    }
} else {
    echo "No transactions found.";
}

$conn->close();
?>