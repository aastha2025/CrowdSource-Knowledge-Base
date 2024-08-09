<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <title>Document</title>
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

        .form-container label {
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
  <?php include "../adminnav.php"; ?>

   <?php
   if (!isset($_SESSION['username'])) {
       // Redirect to login page if the user is not logged in
       header("Location: ../Entry/login.php");
       exit;
   }
    $success = 0;
    $invalid = 0;
    $empty = 0;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (
         $_REQUEST['name'] != '' && $_REQUEST['description'] != ''&& $_FILES['image'] != ''      ) {
         
        $addcat = $_REQUEST['name'];
        $adddesc = $_REQUEST['description'];

        $addimage= $_FILES['image'];
  
        $file = "../images/" . basename($addimage['name']);
        $check = 0;

        if(move_uploaded_file($addimage['tmp_name'], $file)) {
            $check = 1;

        }
        else{
            $check = 0;
        }
  if($check == 1){
        include "../connection.php";
        $sql = "insert into category ( name , description ,image) values(?, ?, ?);";
        $preparestmt = $conn->prepare($sql);
        $preparestmt->bind_param("sss", $addcat, $adddesc, $addimage['name']);
        $preparestmt->execute();
        if (mysqli_affected_rows($conn) > 0) {
          $success = 1;
        } else {
          $invalid = 1;
       }
      } 
      else{
        echo '
        <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
        <strong>Sorry!</strong>Image Uploading Failed .. Try Again ...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
      }
    }
    
    else {
        $empty = 1;
      }
    }
    ?>
    <?php
    if ($success == 1)
      echo '
          
<div class="alert alert-success alert-dismissible fade show m-4" role="alert">
<strong>Congrates!</strong> New Category added...
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        <script>window.open("../admin_manage_category.php","_self")</script>
   ';

    if ($invalid == 1)
      echo '
<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
<strong>Sorry!</strong> Adding category failed ...
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';

    if ($empty == 1)
      echo '
<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
<strong>Alert!</strong> One or More Fields must not be empty...
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';

    ?>


  <div class="form-container">
  <h1 class="text-center"> Add New <span style="color: #06759A;"> Category </span> </h1>
  <form action="admin_Add_Category.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter category name" >
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" placeholder="Enter category description" ></textarea>
            </div>

            <div class="form-group">
                <label for="image">Category Image:</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" >
                <div id="imagePreview" class="file-preview"></div>
            </div>

            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>

  <?php include "../footer.php" ?>

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