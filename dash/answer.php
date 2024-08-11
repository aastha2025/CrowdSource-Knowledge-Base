<?php
include "../connection.php";
session_start();

if (!isset($_SESSION['username'])) {
    die("You must be logged in to view this page.");
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM ask_tb WHERE view = 1 ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions - CrowdSource</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        .question-card {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .question-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }
        .question-card .card-title {
            color: #007bff;
            font-size: 1.25rem;
        }
        .question-card .card-text {
            font-size: 1rem;
            color: #495057;
        }
        .question-card .text-muted {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <?php include "nav.php"; ?>

    <div class="container my-5">
        <h1 class="mb-4">Latest Questions</h1>

        <?php if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                echo '
                <div class="question-card mb-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">' . $row['title'] . '</h5>
                    </div>
                    <p class="card-text">' . $row['description'] . '</p>';
                    echo'
                    <small class="text-muted">Posted by ' . $row['username'] . ' - ' . $row['created_at'] . '</small>';
             
        }
    }

?>
</body>
</html>
