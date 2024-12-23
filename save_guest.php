<?php
// Include database connection file
include 'connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $guestName = $_POST['guest-name'];
    $guestEmail = $_POST['guest-email'];
    $guestPhone = $_POST['guest-phone'];

    // Validate data
    if (!empty($guestName) && !empty($guestEmail) && !empty($guestPhone)) {
        // Prepare SQL query to insert guest data
        $sql = "INSERT INTO guests (name, email, phone) VALUES (?, ?, ?)";

        // Use prepared statements
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $guestName, $guestEmail, $guestPhone);

        // Execute the query
        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();

            // Redirect to guest management page with a success status
            header("Location: guestmanagement.php?status=success");
            exit;
        } else {
            // Close the statement
            $stmt->close();

            // Redirect to guest management page with an error status
            header("Location: guestmanagement.php?status=error");
            exit;
        }
    } else {
        // Redirect to guest management page with an empty field error
        header("Location: guestmanagement.php?status=empty");
        exit;
    }
}

// Close the database connection
$conn->close();
?>
