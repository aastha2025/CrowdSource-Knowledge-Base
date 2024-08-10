<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
            color: #212121;
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

        .form-container .form-group {
            margin-bottom: 20px;
        }

        .form-container .form-group label {
            font-size: 16px;
        }

        .file-preview img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php include "../adminnav.php"; ?>

<?php
include "../connection.php";

if (!isset($_GET['id']) || !isset($_GET['type'])) {
    die("Missing parameters");
}

$id = $_GET['id'];
$type = $_GET['type'];

if ($type !== 'post') {
    die("Invalid type. Only 'post' type is allowed.");
}

$sql = "SELECT * FROM post_tb WHERE id=?";
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
$image = $row['image'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['category'])) {
        $utitle = $_POST['title'];
        $udescription = $_POST['description'];
        $ucategory = $_POST['category'];
        
        $uimage = $image; // Default to current image

        // Handle file upload
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $file = "../postimage/" . basename($image);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                $uimage = $image;
            } else {
                echo "File upload failed.";
                exit;
            }
        }

        $sql = "UPDATE post_tb SET title = ?, description = ?, category = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $utitle, $udescription, $ucategory, $uimage, $id);

        if ($stmt->execute()) {
            echo '<script>window.location.href = "../admin.php";</script>';
        } else {
            echo "ERROR: " . $stmt->error;
        }
    } else {
        echo "All fields are required.";
    }
}
?>

<div class="form-container">
    <h1 class="text-center">Update <span style="color: #06759A;">Post</span></h1>
    <form action="post_update.php?id=<?php echo $id; ?>&type=<?php echo $type; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" style="height: 100px;" required><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" class="form-control" value="<?php echo htmlspecialchars($category); ?>" required>
        </div>

        <div class="form-group">
            <label for="image">Change Image:</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            <div id="imagePreview" class="file-preview">
                <?php if ($image): ?>
                    <img src="../postimage/<?php echo htmlspecialchars($image); ?>" alt="Current Post Image" height="200" width="200">
                <?php endif; ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Post</button>
    </form>
</div>

<?php include "../footer.php"; ?>

<script>
    document.getElementById('image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = ''; // Clear previous previews

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Image Preview';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>
