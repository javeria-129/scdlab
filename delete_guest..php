<?php
// Connect to the database
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete query
    $sql = "DELETE FROM guests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    // Execute the query and check for success
    if ($stmt->execute()) {
        header('Location: guest_management_page.php?success=true');
    } else {
        header('Location: guest_management_page.php?error=true');
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
