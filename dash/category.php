<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

    .col-md-4, .col-md-8 {
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

         .carousel-container {
            margin-top: 0; /* Remove space above carousel */
        }

        .carousel-inner img {
            width: 100%;
            height: auto; /* Maintain aspect ratio */
        }

        .carousel-item {
            height: 100vh; /* Full height of the viewport */
            max-height: 600px; /* Adjust max height for laptop screens */
        }

        @media (min-width: 992px) {
            .carousel-item img {
                height: 500px; /* Adjust height for laptop screens */
            }
        }

        .carousel-control-prev, .carousel-control-next {
            width: 5%; /* Adjust width of carousel controls */
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: rgba(0,0,0,0.5); /* Darken control icons */
            border-radius: 50%;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <!-- Navbar -->
    <?php include "./nav.php" ?>
  
    <!-- Carousel-->
        <div class="container-fluid p-0">
        <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
     <div class="carousel-item">
      <img src="./img/IOT.avif" class="d-block w-100" alt="IOT">
    </div>
    <div class="carousel-item">
      <img src="./img/DS.avif" class="d-block w-100" alt="DS">
    </div>
    <div class="carousel-item active">
      <img src="./img/AI.avif" class="d-block w-100" alt="AI">
    </div>
    <div class="carousel-item">
      <img src="./img/ML.webp" class="d-block w-100" alt="ML">
    </div>
   
    <div class="carousel-item">
      <img src="./img/ROBOTICS.avif" class="d-block w-100" alt="ROBOTICS">
    </div>
    <div class="carousel-item">
      <img src="./img/UI.avif" class="d-block w-100" alt="UI/UX">
    </div>
</div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>


<div class="container">

<h1 class="text-center">Categories</h1>
<div class="row">

 <?php   

  if (!isset($_SESSION['username'])) {
    // Redirect to login page if the user is not logged in
    header("Location: ../Entry/login.php");
    exit;
}
 include "../connection.php";
 
  
    $sql = "SELECT * FROM category ;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $no = 1;

     while($row = $result->fetch_assoc()){
       $name =  $row['name'];
       $description = $row['description'];
       $shortDescription = substr($description, 0, 200);
       $image = $row['image'];
       $id = $row['id'];
       $view = $row['view'];
       if($view) {

    echo '
      
    <div class="col-md-4">
                    <div class="card">
                        <img src="../images/' .$image .'" class="card-img-top" alt=" category image">
                        <div class="card-body">
                            <h5 class="card-title">'.$name.'</h5>
                            <p class="card-text">'. $shortDescription .'....</p>
                            <a href="category_details.php?id='.$id.'" class="btn btn-primary btn-more">More</a>
                        </div>
                    </div>
                </div>
    ';
       }
    $no++;
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

<!--  footer -->
  <?php include "./footer.php" ?>
</body>
</html>