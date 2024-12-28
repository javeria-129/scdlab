<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Management</title>
    <link rel="stylesheet" href="eventcreation.css">
</head>
<body>
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
        <h1>Budget Management</h1>
    </header>
    <main>
        <section>
            <h2>Manage Your Event Budget</h2>
            <p>Efficiently allocate and track your event's budget with ease.</p>
        </section>

        <section>
            <h2>Set Your Budget</h2>
            <form id="budget-form" method="post">
                <!-- Event Name -->
                <label for="budget-event-name">Event Name</label>
                <input type="text" id="budget-event-name" name="budget-event-name" placeholder="Enter event name" required>

                <!-- Total Budget -->
                <label for="total-budget">Total Budget</label>
                <input type="number" id="total-budget" name="total-budget" placeholder="Enter total budget" required>

                <!-- Expense Categories -->
                <label for="venue-cost">Venue Cost</label>
                <input type="number" id="venue-cost" name="venue-cost" placeholder="Enter venue cost" required>

                <label for="catering-cost">Catering Cost</label>
                <input type="number" id="catering-cost" name="catering-cost" placeholder="Enter catering cost" required>

                <label for="decoration-cost">Decoration Cost</label>
                <input type="number" id="decoration-cost" name="decoration-cost" placeholder="Enter decoration cost" required>

                <label for="miscellaneous-cost">Miscellaneous Cost</label>
                <input type="number" id="miscellaneous-cost" name="miscellaneous-cost" placeholder="Enter miscellaneous cost" required>

                <!-- Notes -->
                <label for="budget-notes">Additional Notes</label>
                <textarea id="budget-notes" name="budget-notes" rows="5" placeholder="Add any notes or descriptions..."></textarea>

                <!-- Submit Button -->
                <button type="submit" name="submitBudget">Submit Budget</button>
            </form>
        </section>

        <section id="budget-preview-section">
            <h3>Budget Preview</h3>
            <div id="budget-preview">
                <h4 id="preview-name">Event Name</h4>
                <p><strong>Total Budget:</strong> <span id="preview-total"></span></p>
                <p><strong>Venue Cost:</strong> <span id="preview-venue"></span></p>
                <p><strong>Catering Cost:</strong> <span id="preview-catering"></span></p>
                <p><strong>Decoration Cost:</strong> <span id="preview-decoration"></span></p>
                <p><strong>Miscellaneous Cost:</strong> <span id="preview-misc"></span></p>
                <p><strong>Notes:</strong> <span id="preview-notes"></span></p>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Event Platform</p>
    </footer>

    <script>
        // Dynamic Budget Preview
        document.getElementById('budget-form').addEventListener('input', function () {
            document.getElementById('preview-name').textContent = document.getElementById('budget-event-name').value || "Event Name";
            document.getElementById('preview-total').textContent = document.getElementById('total-budget').value || "Total Budget";
            document.getElementById('preview-venue').textContent = document.getElementById('venue-cost').value || "Venue Cost";
            document.getElementById('preview-catering').textContent = document.getElementById('catering-cost').value || "Catering Cost";
            document.getElementById('preview-decoration').textContent = document.getElementById('decoration-cost').value || "Decoration Cost";
            document.getElementById('preview-misc').textContent = document.getElementById('miscellaneous-cost').value || "Miscellaneous Cost";
            document.getElementById('preview-notes').textContent = document.getElementById('budget-notes').value || "Additional Notes";
        });

        // Validate Event Name
        document.getElementById('budget-event-name').addEventListener('input', function (e) {
            const regex = /^[a-zA-Z\s]*$/;
            if (!regex.test(e.target.value)) {
                alert('Event name can only contain letters and spaces.');
                e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, '');
            }
        });

        // Form Submission Notification
        document.getElementById('budget-form').addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Budget submitted successfully!');
        });
    </script>
</body>
</html>
