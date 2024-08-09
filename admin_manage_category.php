<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
    <!-- <link rel="stylesheet" href="category.css"> -->
    <style>
        .sidebar .list-group-item a {
            text-decoration: none;
            color: #000;
            font-size: 16px;
            transition: font-size 0.3s ease;
        }

        .sidebar .list-group-item a:hover {
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .col-md-4,
            .col-md-8 {
                flex: 1 0 100%;
            }
        }

        .card {
            margin-bottom: 20px;
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .card-text {
            flex: 1;
        }

        .btn-more {
            margin-top: auto;
        }

        .btn-update,
        .btn-delete {
            margin-bottom: 10px;
            /* Add space between buttons */
            border-radius: 5px;
            padding: 10px;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-update {
            background-color: #28a745;
            /* Green */
            border: none;
        }

        .btn-delete {
            background-color: #dc3545;
            /* Red */
            border: none;
        }

        .btn-update:hover {
            background-color: #218838;
            /* Darker green */
        }

        .btn-delete:hover {
            background-color: #c82333;
            /* Darker red */
        }

       
        .tooltip-inner {
            background-color: #007bff;
            color: #fff;
        }
        .tooltip-arrow {
            border-top-color: #007bff;
        }
       
    </style>
    <title>Document</title>
</head>

<body>
    <!-- Navbar -->
    <?php include "adminnav.php" ?>

    <div class="container">

        <h1 class="text-center">Categories</h1>
        <div class="row">

            <?php

            if (!isset($_SESSION['username'])) {
                // Redirect to login page if the user is not logged in
                header("Location: ../Entry/login.php");
                exit;
            }
            include "connection.php";


            $sql = "SELECT * FROM category ;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $name =  $row['name'];
                $description = $row['description'];
                $shortDescription = $description;
                $image = $row['image'];
                $id = $row['id'];
                $view = $row['view'];



                    echo '
      
    <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <img src="./images/' . $image . '" class="card-img-top" alt=" category image">
                        <div class="card-body">
                            <h5 class="card-title">' . $name . '</h5>
                            <p class="card-text">' . substr($shortDescription, 0, 100) . '......</p>
                             
                            <div class="row mb-2">
                              <div class="col-md-6 col-sm-12">
                                  <a href="./admincategory/category_update.php?id=' . $id . '" class="btn btn-info w-100 ">Update</a>
                              </div>
                              <div class="col-md-6 col-sm-12"> ';
                              if($view) {
                                echo '<a href="./admincategory/category_delete.php?id=' . $id . '"  class="btn btn-danger w-100 ">HIDE</a>';
                              }else {
                                echo '<a href="./admincategory/category_delete.php?id=' . $id . '"  class="btn btn-success w-100 ">SHOW</a>';
                              } 
                                  echo ' 
                              </div>
                            </div>
                            <a href="./admincategory/category_details.php?id=' . $id . '" class="btn btn-primary btn-more">More</a>
                        </div>
                    </div>
                </div>
                ';

            }
            if ($result->num_rows === 0) {
                echo '
        <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
        <strong>Sorry!</strong>For this category Please request to admin to add .... Try Again ...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
            }

            ?>
        </div>
</div>

<button class="btn btn-success rounded-circle add-btn mb-2" data-bs-toggle="tooltip" data-bs-placement="bottom-right" title="Add More Category">
        <a href="./admincategory/admin_Add_Category.php" class="text-white text-decoration-none">+</a>
    </button>
    <!--  footer -->
    <?php include "./footer.php" ?>

    
<script>
    document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
</script>
</body>

</html>