<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "connection.php"; // Ensure this path is correct

    // Sanitize and validate inputs
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = $_POST['message'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo '<p class="error">Invalid email format.</p>';
        exit;
    }

    // Prepare and execute SQL statement to insert message
    $sql = "INSERT INTO contact_us (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Get the last inserted message ID
        $message_id = $conn->insert_id;

        // Notify the admin
        $sql_notify = "INSERT INTO admin_notifications (message_id, username, details) VALUES (?, ?, ?)";
        $stmt_notify = $conn->prepare($sql_notify);
        $username = 'admin'; // or fetch from session if needed
        $details = "New message from $name. Email: $email. Message: $message";
        $stmt_notify->bind_param("iss", $message_id, $username, $details);
        $stmt_notify->execute();

        echo '<p class="success">Message sent successfully. We will get back to you soon.</p>';
    } else {
        echo '<p class="error">Failed to send message. Please try again later.</p>';
    }
}
?>
