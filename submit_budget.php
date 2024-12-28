<?php
// Include the database connection file
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $eventName = $_POST['budget-event-name'];
    $totalBudget = $_POST['total-budget'];
    $venueCost = $_POST['venue-cost'];
    $cateringCost = $_POST['catering-cost'];
    $decorationCost = $_POST['decoration-cost'];
    $miscellaneousCost = $_POST['miscellaneous-cost'];
    $notes = $_POST['budget-notes'];

    // Prepare SQL query to insert data
    $sql = "INSERT INTO budget_management (
                event_name, 
                total_budget, 
                venue_cost, 
                catering_cost, 
                decoration_cost, 
                miscellaneous_cost, 
                notes
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sddddds", 
        $eventName, 
        $totalBudget, 
        $venueCost, 
        $cateringCost, 
        $decorationCost, 
        $miscellaneousCost, 
        $notes
    );

    // Execute the query
    if ($stmt->execute()) {
        echo "Budget details saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
