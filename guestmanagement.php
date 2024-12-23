<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Management</title>
    <link rel="stylesheet" href="eventcreation.css">
    <style>
        .notification {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid transparent;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            position: fixed; /* Keep it fixed at the top */
            top: 70px; /* Adjust this value to position it below the navbar */
            left: 0;
            right: 0;
            z-index: 1000; /* Ensure it stays above other content */
        }
        
        .notification.success {
            color: green;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        
        .notification.error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        
    </style>
</head>
<body>
    <!-- Add the notification container -->
    <div id="notification"></div>

    <nav class="Navbar">
        <ul>
            <li><img src="events.jfif" alt="Logo" class="logo"></li>
            <li><a href="home.html">HOME</a></li>
            <li><a href="#">ABOUT</a></li>
            <li><a href="services.html">SERVICES</a></li>
            <li><a href="#">GALLERY</a></li>
            <li><a href="#">CONTACT</a></li>
            <li><a href="index.php">LOGIN</a></li>
            <li class="search">
                <input type="text" placeholder="Search...">
                <button type="submit">Search</button>
            </li>
        </ul>
    </nav>

    <header>
        <h1>Guest Management</h1>
    </header>

    <main>
        <section>
            <h2>Manage Your Guests</h2>
            <p>Add, update, and manage your event guests with ease.</p>
        </section>

        <section>
            <h2>Add Guest</h2>
            <form id="guest-form" method="post" action="save_guest.php">
                <!-- Guest Name -->
                <label for="guest-name">Guest Name</label>
                <div id="name-error" style="color: red; display: none;"></div>
                <input type="text" id="guest-name" name="guest-name" placeholder="Enter guest name" required> 

                <!-- Guest Email -->
                <label for="guest-email">Guest Email</label>
                <div id="email-error" style="color: red; display: none;"></div>
                <input type="email" id="guest-email" name="guest-email" placeholder="Enter guest email" required>

                <!-- Guest Phone -->
                <label for="guest-phone">Phone Number</label>
                <div id="phone-error" style="color: red; display: none;"></div> 
                <input type="tel" id="guest-phone" name="guest-phone" placeholder="Enter guest phone number" required>

                <!-- Submit Button -->
                <button type="submit" name="addGuest">Add Guest</button>
            </form>
        </section>

        <section>
    <h2>Guest List</h2>
    <div id="guest-list">
        <?php
        // Include the database connection file
        include 'connect.php';

        // Query to fetch all guests
        $sql = "SELECT * FROM guests";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display each guest in the list
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . htmlspecialchars($row['name']) . " - " . htmlspecialchars($row['email']) . " - " . htmlspecialchars($row['phone']) . 
                     " <a href='edit_guest.php?id=" . $row['id'] . "'>Edit</a> | 
                     <a href='guest_management/delete_guest.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this guest?\")'>Delete</a></p>";
            }
        } else {
            echo "<p>No guests added yet.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</section>

    </main>

    <footer>
        <p>&copy; 2024 Event Platform</p>
    </footer>

    <script>
    // Form Validation
    document.getElementById('guest-form').onsubmit = function (e) {
        const guestName = document.getElementById('guest-name').value;
        const guestEmail = document.getElementById('guest-email').value;
        const guestPhone = document.getElementById('guest-phone').value;

        // Validate guest name (only letters)
        const nameRegex = /^[A-Za-z\s]+$/;
        const nameError = document.getElementById('name-error');
        if (!nameRegex.test(guestName)) {
            e.preventDefault(); // Prevent form submission
            nameError.textContent = "Invalid guest name. Only letters are allowed."; // Display error message
            nameError.style.display = 'block'; // Show error message
            document.getElementById('guest-name').focus(); // Focus on the guest name field
            return false;
        } else {
            nameError.style.display = 'none'; // Hide error message if valid
        }

        // Validate email format
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const emailError = document.getElementById('email-error');
        if (!emailRegex.test(guestEmail)) {
            e.preventDefault(); // Prevent form submission
            emailError.textContent = "Invalid email format. Please enter in this format: example@domain.com"; // Display error message
            emailError.style.display = 'block'; // Show error message
            document.getElementById('guest-email').focus(); // Focus on the email field
            return false;
        } else {
            emailError.style.display = 'none'; // Hide error message if valid
        }

        // Validate phone number (must start with +92 and be followed by 9 digits)
        const phoneRegex = /^\+92\d{9}$/;
        const phoneError = document.getElementById('phone-error');
        
        // Clean up phone number input (trim spaces, ensure no non-numeric characters)
        const cleanedPhone = guestPhone.trim().replace(/\D/g, ''); // Remove non-numeric characters

        // Check if the cleaned phone number matches the required pattern
        if (!phoneRegex.test(`+${cleanedPhone}`)) {
            e.preventDefault(); // Prevent form submission
            phoneError.textContent = "Phone number must start with +92 and be followed by 9 digits, e.g., +923329411087"; // Display error message
            phoneError.style.display = 'block'; // Show error message
            document.getElementById('guest-phone').focus(); // Focus on the phone field
            return false;
        } else {
            phoneError.style.display = 'none'; // Hide error message if valid
        }
    };

    // Prevent tabbing to next fields until the name is valid
    document.getElementById('guest-name').addEventListener('input', function () {
        const guestName = this.value;
        const nameRegex = /^[A-Za-z\s]+$/;
        const nameError = document.getElementById('name-error');

        if (nameRegex.test(guestName)) {
            // If the name is valid, allow moving to next field (email)
            document.getElementById('guest-email').removeAttribute('disabled');
            nameError.style.display = 'none'; // Hide error message
        } else {
            // If invalid, keep the email field disabled and show error
            document.getElementById('guest-email').setAttribute('disabled', 'true');
            nameError.textContent = "Invalid guest name. Only letters are allowed."; // Display error message
            nameError.style.display = 'block'; // Show error message
        }
    });

    // Prevent tabbing to next fields until the email is valid
    document.getElementById('guest-email').addEventListener('input', function () {
        const guestEmail = this.value;
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const emailError = document.getElementById('email-error');

        if (emailRegex.test(guestEmail)) {
            // If the email is valid, allow moving to next field (phone)
            document.getElementById('guest-phone').removeAttribute('disabled');
            emailError.style.display = 'none'; // Hide error message
        } else {
            // If invalid, keep the phone field disabled and show error
            document.getElementById('guest-phone').setAttribute('disabled', 'true');
            emailError.textContent = "Invalid email format. Please enter in this format: example@domain.com"; // Display error message
            emailError.style.display = 'block'; // Show error message
        }
    });

    // Show a notification for success or error
    function showNotification(message, type) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = 'notification ' + type;

        setTimeout(function () {
            notification.textContent = '';
            notification.className = 'notification';
        }, 5000); // Hide after 5 seconds
    }
    
    // Check URL for query string
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        showNotification("Guest added successfully!", 'success');
    } else if (urlParams.has('error')) {
        showNotification("An error occurred while adding the guest.", 'error');
    }
    </script>
</body>
</html>
