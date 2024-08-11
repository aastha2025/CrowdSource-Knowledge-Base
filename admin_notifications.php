<?php
include "connection.php";

// Fetch unread messages
$sql = "SELECT * FROM contact_us WHERE status = 'unread'";
$result = $conn->query($sql);
$unread_count = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #333;
    margin-bottom: 10px;
}

p {
    font-size: 16px;
    color: #666;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f8f8f8;
    color: #333;
}

td {
    background-color: #fff;
}

tr:nth-child(even) td {
    background-color: #f9f9f9;
}

a {
    color: #06759A;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

.table-container {
    overflow-x: auto;
}

.container h2 {
    margin-top: 0;
    color: #333;
}

.container table {
    border-radius: 8px;
    overflow: hidden;
}

.container table th {
    background-color: #007bff;
    color: #fff;
}

.container table td a {
    color: #007bff;
}

.container table td a:hover {
    color: #0056b3;
}

    </style>
    
</head>
<body>
    <?php include "adminnav.php"; ?>

    <div class="container">
        <h1>Admin Notifications</h1>
        <p>You have <?php echo $unread_count; ?> unread messages.</p>

        <h2>Unread Messages</h2>
        <table>
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM contact_us";
             $preparestmt = $conn->prepare($sql);
            $preparestmt->execute();
            $result = $preparestmt->get_result();
                 
                   while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['message'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td><a href='mark_as_read.php?id=" . $row['id'] . "'>Mark as Read</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
