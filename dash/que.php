<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKnowledge Base</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
       .container {
            position: relative;
        }
        .horizontal-scroll-container {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px 0;
        }
        .card {
            display: inline-block;
            width: 300px; /* Adjust width as needed */
            margin-right: 10px; /* Adjust margin as needed */
        }
        .scroll-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            z-index: 10;
        }
        #scroll-left {
            left: 10px;
            position: 290px;
        }
        #scroll-right {
            right: 10px;
        }
</style>
</head>

<body>
    <!-- Navbar -->
    <?php include "./nav.php" ?>


    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Categories -->
            <!-- Categories -->
            <div class="col-md-4 sidebar">
                <h4 class="ml-2">Questions</h4>
                <ul class="list-group">
                    <li class="list-group-item"><a href="./que.php">Questions for you</a></li>
                     <!-- Add more related topics as needed -->
                </ul>
            </div>

                <!-- Questions/Posts -->
                <div class="col-md-8 questions-feed">
            <?php
            if (!isset($_SESSION['username'])) {
                // Redirect to login page if the user is not logged in
                header("Location: ../Entry/login.php");
                exit;
              }
            include "../connection.php";
            
            // Fetch questions from the database
            $sql = "SELECT * FROM ask_tb ORDER BY created_at DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $title = $row['title'];
                $description = $row['description'];
                $created_at = $row['created_at'];
                // Assuming a placeholder username and time for now
                $username = $row['username'];
            
                echo '
                <div class="question-card mb-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">' . $title . '</h5>
                        <button class="btn btn-sm btn-outline-secondary">Follow</button>
                    </div>
                    <p class="card-text">' . $description . '</p>

                    <div class="d-flex justify-content-between">
                        <div>
                             <button class="btn btn-sm btn-link">Answers</button>
                            <button class="btn btn-sm btn-link">Upvote</button>
                            <button class="btn btn-sm btn-link">Share</button>
                          </div>
                        <small class="text-muted">Posted by ' . $username . ' - ' . $created_at . '</small>
                    </div>
                </div>
                ';
            }

            $conn->close();
?>
</div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col md-4">
          
        </div>
        <div class="col-md-8">
        <div class="horizontal-scroll-container">
            <?php 
                include "../connection.php";
                
                $sql = "SELECT * FROM category ;";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                while($row = $result->fetch_assoc()){
                    $name =  $row['name'];
                    $image = $row['image'];
                    $id = $row['id'];
                    $view = $row['view'];
                    if($view) {
                        echo '
                            <div class="card">
                                <img src="../images/' .$image .'" class="card-img-top" alt="category image">
                                <div class="card-body">
                                    <h5 class="card-title">'.$name.'</h5>
                                    <a href="category_details.php?id='.$id.'" class="btn btn-primary btn-more">More</a>
                                </div>
                            </div>
                        ';
                    }
                }
            ?>
        </div>
        <button class="scroll-button" id="scroll-left">←</button>
        <button class="scroll-button" id="scroll-right">→</button>
    </div>
</div>
</div>
</div>
    <?php include "./footer.php"   ?>
</body>

<script>
        const scrollContainer = document.querySelector('.horizontal-scroll-container');
        const scrollLeftButton = document.getElementById('scroll-left');
        const scrollRightButton = document.getElementById('scroll-right');

        scrollLeftButton.addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: -300, // Adjust scroll amount as needed
                behavior: 'smooth'
            });
        });

        scrollRightButton.addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: 300, // Adjust scroll amount as needed
                behavior: 'smooth'
            });
        });
    </script>

</html>