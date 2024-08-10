<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .container1 {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .container1 h1 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        .container1 form {
            display: flex;
            flex-direction: column;
        }

        .container1 label {
            display: block;
            margin-bottom: 8px;
        }

        .container1 input[type="text"],
        .container1 textarea,
        .container1 select,
        .container1 input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .container1 textarea {
            resize: vertical;
            min-height: 100px;
        }

        .container1 button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }

        .container1 button:hover {
            background-color: #0056b3;
        }

        .file-preview img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
        }

        .scrollable-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
        }

        .tag-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            background-color: #f1f1f1;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .tag-item button {
            background: none;
            border: none;
            color: #d9534f;
            font-size: 18px;
            margin-left: 10px;
            cursor: pointer;
        }

        .tag-item button:hover {
            color: #c9302c;
        }
    </style>
</head>

<body>
    <?php include "../adminnav.php"; ?>

    <?php
    ob_start();
   
    if (!isset($_SESSION['username'])) {
        echo '<script>window.open("../Entry/login.php", "_self");</script>';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include "../connection.php";

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $category = $_POST['category'] ?? '';
        $addimage = $_FILES['image'] ?? '';

        $errors = [];
        $createdAt = date('Y-m-d H:i:s');
        $username = $_SESSION['username'];
       
        if (empty($title) || empty($description) || empty($category) || empty($addimage['name'])) {
            $errors[] = '<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                <strong>ALERT!</strong> One or more fields must not be empty...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        if (empty($errors)) {
            $checkSql = "SELECT * FROM post_tb WHERE title = ?";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bind_param("s", $title);
            $checkStmt->execute();
            $result = $checkStmt->get_result();

            if ($result->num_rows > 0) {
                echo '<div class="alert alert-warning alert-dismissible fade show m-4" role="alert">
                    <strong>ALERT!</strong> Post already exists...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {
                $file = "../postimage/" . basename($addimage['name']);
                $upload = 1;
                
                if ($check === false) {
                    $upload = 0;
                    $errors[] = '<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                        <strong>ERROR!</strong> File is not an image.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
    

                if ($upload && move_uploaded_file($addimage['tmp_name'], $file)) {
                    $sql = "INSERT INTO post_tb (title, description, category, created_at, username, image) VALUES (?,?,?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssss", $title, $description, $category, $createdAt, $username, $addimage['name'] );
                    if ($stmt->execute()) {
                        echo '<div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                            <strong>Congrats!</strong> Post submitted successfully...
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        ob_end_clean();
                        echo "<script>window.open('index.php', '_self');</script>";
                        exit();
                    } else {
                        $errors[] = '<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                            <strong>ERROR!</strong> Error adding post. Please try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                        <strong>ERROR!</strong> Something went wrong...
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
        }

        foreach ($errors as $error) {
            echo $error;
        }
    }
    ?>
    
    <div class="container1">
        <h1 class="text-center">Create<span style="color: #06759A;"> Post</span></h1>
        <form id="postForm" method="post" action="post.php" enctype="multipart/form-data">
            <label for="title">Post Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <?php
            include "../connection.php";
            $sql1 = "SELECT * FROM category";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->execute();
            $result = $stmt1->get_result();
            ?>
            <label for="category">Category:</label>
            <select id="category" name="category">
                <option value="">Select a Category</option>
                <?php
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                    }
                ?>
            </select> 
            <div class="form-group">
                <label for="image">Post Image:</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" >
                <div id="imagePreview" class="file-preview"></div>
            </div>
            
            <button type="submit">Submit Post</button>
        </form>
    </div>

    <?php include "../footer.php" ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectedTags = document.getElementById('selectedTags');
            const checkboxes = document.querySelectorAll('.scrollable-list .form-check-input');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const tag = checkbox.nextElementSibling.textContent.trim();
                    if (checkbox.checked) {
                        // Add the tag to the selectedTags container
                        const tagItem = document.createElement('div');
                        tagItem.className = 'tag-item';
                        tagItem.textContent = tag;
                        const removeButton = document.createElement('button');
                        removeButton.innerHTML = '&times;';
                        removeButton.addEventListener('click', () => {
                            checkbox.checked = false;
                            tagItem.remove();
                        });
                        tagItem.appendChild(removeButton);
                        selectedTags.appendChild(tagItem);
                    } else {
                        // Remove the tag from the selectedTags container
                        Array.from(selectedTags.children).forEach(tagItem => {
                            if (tagItem.textContent.trim().startsWith(tag)) {
                                tagItem.remove();
                            }
                        });
                    }
                });
            });
        });
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
