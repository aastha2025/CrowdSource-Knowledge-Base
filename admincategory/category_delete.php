<?php
include "../connection.php";

$id = $_REQUEST['id'];

$sql = "SELECT * FROM category WHERE id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$view = $row["view"];
$view = !$view;

$sql = "UPDATE category SET view = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii",$view, $id);

if ($stmt->execute()) {
    // header("Location: ../../admin_manage_category.php");
    echo ' 
    <script>window.open("../admin_manage_category.php","_self")</script>
    ';
} 
else {
    echo "ERROR";
}

?>