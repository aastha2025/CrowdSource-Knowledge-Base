<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .form-container {
            max-width: 700px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            font-size: 32px;
            margin-bottom: 20px;
            text-align: center;
            color:#212121;
        }

        .form-container input, 
        .form-container textarea, 
        .form-container select, 
        .form-container button {
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .form-container input[type="file"] {
            padding: 0;
        }

        .form-container textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-container button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 15px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.3s ease;
            width: 100%;
        }

        .form-container button:hover {
            background-color: #0056b3;
            color: #ffffff;
            transform: scale(1.05);
        }

        .form-container .alert {
            margin-top: 20px;
        }

        .form-container .file-preview {
            margin-top: 10px;
            text-align: center;
        }

        .form-container .file-preview img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container .form-group {
            margin-bottom: 20px;
        }

        .form-container .form-group label {
            font-size: 16px;
        }
    </style>
</head>
<body>
<?php include "nav.php"; ?>

<?php
include "../connection.php";

if (!isset($_GET['id']) || !isset($_GET['type'])) {
    die("Missing parameters");
}

$id = $_GET['id'];
$type = $_GET['type'];

// Ensure type is 'ask' to proceed
if ($type !== 'ask') {
    die("Invalid type. Only 'ask' type is allowed.");
}

$sql = "SELECT * FROM ask_tb WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No record found");
}

$row = $result->fetch_assoc();

$title = $row['title'];
$description = $row['description'];
$category = $row['category'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['category'])) {
        $utitle = $_POST['title'];
        $udescription = $_POST['description'];
        $ucategory = $_POST['category'];
        
        $sql = "UPDATE ask_tb SET title = ?, description = ?, category = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $utitle, $udescription, $ucategory, $id);

        if ($stmt->execute()) {
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            echo "ERROR: " . $stmt->error;
        }
    } else {
        echo "All fields are required.";
    }
}
?>



<div class="form-container">
    <h1 class="text-center">Update <span style="color: #06759A;">Question</span></h1>
    <form action="update.php?id=<?php echo $id; ?>&type=<?php echo $type; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo ' '.$title .' '; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" style="height: 100px;" required><?php echo' '.$description .' '; ?></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" class="form-control" value="<?php echo ' '.$category .' '; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Question</button>
    </form>
</div>

<?php include "../footer.php"; ?>

</body>
</html>
