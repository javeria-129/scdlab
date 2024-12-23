<?php
// Include the database connection file
include 'connect.php';

// Check if the ID parameter is present in the URL
if (isset($_GET['id'])) {
    $guestId = $_GET['id'];

    // Fetch the guest data from the database
    $sql = "SELECT * FROM guests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $guestId);
    $stmt->execute();
    $result = $stmt->get_result();
    $guest = $result->fetch_assoc();

    // Check if the guest exists
    if (!$guest) {
        echo "Guest not found.";
        exit;
    }
} else {
    echo "No guest ID provided.";
    exit;
}

// Handle the form submission for updating the guest details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guestName = $_POST['guest-name'];
    $guestEmail = $_POST['guest-email'];
    $guestPhone = $_POST['guest-phone'];

    // Validate the form data
    if (!empty($guestName) && !empty($guestEmail) && !empty($guestPhone)) {
        $sql = "UPDATE guests SET name = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $guestName, $guestEmail, $guestPhone, $guestId);

        if ($stmt->execute()) {
            // Redirect to guest management page after updating
            header("Location: guestmanagement.php?status=updated");
            exit;
        } else {
            echo "Error updating guest.";
        }
    } else {
        echo "Please fill in all fields.";
    }
}

// Close the database connection
$conn->close();
?>

<!-- HTML Form to Edit Guest -->
<form method="POST">
    <label for="guest-name">Guest Name</label>
    <input type="text" id="guest-name" name="guest-name" value="<?php echo htmlspecialchars($guest['name']); ?>" required>

    <label for="guest-email">Guest Email</label>
    <input type="email" id="guest-email" name="guest-email" value="<?php echo htmlspecialchars($guest['email']); ?>" required>

    <label for="guest-phone">Phone Number</label>
    <input type="tel" id="guest-phone" name="guest-phone" value="<?php echo htmlspecialchars($guest['phone']); ?>" required>

    <button type="submit">Update Guest</button>
</form>
