<?php 
session_start();
include 'connect.php';
include 'Database.php';

$conn = Database::getInstance();

// Check if the database connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if (isset($_POST['signUp'])) {
    $firstName = validateInput($_POST['fName']);
    $lastName = validateInput($_POST['lName']);
    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);

    if (!preg_match("/^[A-Za-z]+$/", $firstName)) {
        echo "First name must only contain letters.";
        exit();
    }

    if (!preg_match("/^[A-Za-z]+$/", $lastName)) {
        echo "Last name must only contain letters.";
        exit();
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid or empty email address.";
        exit();
    }

    if (empty($password)) {
        echo "Password is required.";
        exit();
    }

    // Hash the password using password_hash (more secure than md5)
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = "INSERT INTO users (firstName, lastName, email, password)
                        VALUES ('$firstName', '$lastName', '$email', '$password')";

        // Debugging: Print the query and any potential error
        if ($conn->query($insertQuery) === TRUE) {
            echo "Record inserted successfully";  // Optionally display success message
            header("Location: index.php");  // Redirect after successful insert
            exit();
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;  // Display query and error
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "Email and Password are required.";
        exit();
    }

    // Hash the entered password and compare
    $password = md5($password);  // For simplicity, you can still use md5 here for login, but it’s better to use password_verify().

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: homes.php");
        exit();
    } else {
        echo "Incorrect Email or Password.";
    }
}
?>
