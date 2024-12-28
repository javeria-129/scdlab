<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = filter_input(INPUT_POST, 'resource-name', FILTER_SANITIZE_STRING);
    $type = filter_input(INPUT_POST, 'resource-type', FILTER_SANITIZE_STRING);
    $quantity = filter_input(INPUT_POST, 'resource-quantity', FILTER_VALIDATE_INT);
    $date = filter_input(INPUT_POST, 'needed-date', FILTER_SANITIZE_STRING);
    $cost = filter_input(INPUT_POST, 'resource-cost', FILTER_VALIDATE_FLOAT);
    $details = filter_input(INPUT_POST, 'resource-description', FILTER_SANITIZE_STRING);

    // Validation
    if (!$name || !$quantity || !$cost) {
        echo "Invalid input. Please ensure all fields are filled correctly.";
        exit;
    }

    // SQL query
    $sql = "INSERT INTO resources (name, type, quantity, needed_date, cost, details)
            VALUES ('$name', '$type', $quantity, '$date', $cost, '$details')";

    if ($conn->query($sql) === TRUE) {
        echo "Resource saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
