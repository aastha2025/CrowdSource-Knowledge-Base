<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        .contain {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Heading style */
        .contain h1 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form element styles */
        .contain form {
            display: flex;
            flex-direction: column;
        }

        /* Label styling */
        .contain label {
            display: block;
            margin-bottom: 8px;
        }

        /* Input and textarea styling */
        .contain input[type="text"],
        .contain textarea,
        .contain select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Textarea specific styling */
        .contain textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Button styling */
        .contain button {
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

        /* Button hover effect */
        .contain button:hover {
            background-color: #0056b3;
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
    <?php include "nav.php" ?>

    
<?php
ob_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login page if the user is not logged in
    header("Location: ../Entry/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../connection.php";
    
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
        
    // Set createdAt and username
    $createdAt = date('Y-m-d H:i:s');
    $username = $_SESSION['username'];

    if (empty($title) || empty($description) || empty($category)) {
        echo '
        <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
            <strong>ALERT!</strong> One or More Fields must not be empty...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    } else {
        $checkSql = "SELECT * FROM ask_tb WHERE title = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $title);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        if ($result->num_rows > 0) {
            echo '
            <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                <strong>ALERT!</strong> Question already exists...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        } else {
            $sql = "INSERT INTO ask_tb (title, description, category, created_at, username) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $title, $description, $category, $createdAt, $username);
            if ($stmt->execute()) {
                echo '
                <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                    <strong>Congrats!</strong> Question Submitted Successfully...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
                ob_end_clean();
                echo "<script>window.open('index.php', '_self');</script>";
                exit();
            } else {
                echo '
                <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                    <strong>ERROR!</strong> Something went wrong...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
        }
    }
}
?>

    <div class="contain">
        <h1>Ask a Question</h1>
        <form id="askForm" method="post" action="">
            <label for="title">Question Title:</label>
            <input type="text" id="title" name="title">

            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>

            <?php
            include "../connection.php";
            $sql1 = "SELECT * FROM category";
            $stmt1 = $conn->prepare($sql1);
            // $stmt1->bind_param
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
            <button type="submit">Submit Question</button>
        </form>
    </div>

    <?php include "footer.php" ?>

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
    </script>
</body>

</html>
