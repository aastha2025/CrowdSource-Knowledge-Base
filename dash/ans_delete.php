<?php 
include ("../connection.php");
session_start();

$username = $_SESSION['username'];
$id = $_REQUEST['id'];


$sql = "DELETE FROM ans_tb WHERE id=? AND username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $username);
if ($stmt->execute()) {
    echo '
        <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
            <strong>Success!</strong> Answer deleted successfully...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    ';
    header('location: index.php');
    exit(); // Ensure the script stops after redirect
} else {
    echo '
        <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
            <strong>Error!</strong> Something went wrong...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    ';
}
