<?php
include "../connection.php";

if (!isset($_REQUEST['id']) || !isset($_REQUEST['type'])) {
    die("Missing parameters");
}

$id = $_REQUEST['id'];
$type = $_REQUEST['type'];

// Determine the table based on the type
$table = '';
if ($type === 'ask') {
    $table = 'ask_tb';
} elseif ($type === 'post') {
    $table = 'post_tb';
} else {
    die("Invalid type. Only 'ask' or 'post' type is allowed.");
}

// Fetch the current view status and toggle it
$sql = "SELECT * FROM $table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("No record found");
}

$view = $row["view"];
$view = !$view;

// Update the view status
$sql = "UPDATE $table SET view = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $view, $id);

if ($stmt->execute()) {
    echo '<script>window.open("index.php","_self")</script>';
} 
?>
