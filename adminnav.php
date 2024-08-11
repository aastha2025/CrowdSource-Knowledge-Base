<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>
<body>
<?php
    session_start(); 
    if (!isset($_SESSION['username'])) {
        // Redirect to login page if the user is not logged in
        header("Location: ../Entry/login.php");
        exit;
    }
    ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <h2>CKnowledge <span class="mylogo">Base</span></h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="admin.php">Manage QUESTION/POST/HOME</a>
                </li>
                <!-- <li class="nav-item mx-2">
                    <a class="nav-link" href="adminques.php">Manage Q/A</a>
                </li> -->

                <?php
                    include "connection.php";

                    // Fetch unread messages count
                    $sql = "SELECT COUNT(*) as unread_count FROM contact_us WHERE status = 'unread'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $unread_count = $row['unread_count'];
                    ?>

                        <li class="nav-item mx-2">
                        <a class="nav-link" href="admin_notifications.php">Manage Notifications (<?php echo $unread_count; ?>)</a>
                        </li>
        
            
                <li class="nav-item mx-2">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search Knowledge" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="./Entry/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>