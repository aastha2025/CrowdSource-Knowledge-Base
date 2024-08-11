<?php
include "connection.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Update the message status to read
    $sql = "UPDATE contact_us SET status = 'read' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin_notifications.php"); // Redirect back to notifications page
        exit();
    } else {
        echo "Failed to update status. Please try again.";
    }
}
?>
