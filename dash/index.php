<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKnowledge Base</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
        
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
                <h4 class="ml-2">Categories</h4>
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">Machine Learning</a></li>
                    <li class="list-group-item"><a href="#">Artificial Intelligence</a></li>
                    <li class="list-group-item"><a href="#">Data Science</a></li>
                    <li class="list-group-item"><a href="#">Internet of Things</a></li>
                    <li class="list-group-item"><a href="#">Robotics</a></li>
                    <li class="list-group-item"><a href="#">UI/UX </a></li>
                    
                    <!-- Add more related topics as needed -->
                </ul>
            </div>

            <!-- Ask a Question and Questions/Posts -->
            <div class="col-md-8 questions-feed">
                <!-- Ask a Question -->
                <div class=" ask-question ">
                    <h5>Every voice contributes to a richer, collective understanding !!</h5>
                    <form action="submit_question.php" method="POST">
                        <div class="form-group">
                            <textarea class="form-control" name="question" rows="3" placeholder="What you want to share?"></textarea>
                        </div>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <a href="ask.php" class="btn btn-custom-ask btn-block">Ask</a>
                                </div>
                                <!-- <div class="col-md-4 mb-2">
                                    <a href="answer.php" class="btn btn-custom-answer btn-block">Answer</a>
                                </div> -->
                                <div class="col-md-6 mb-2">
                                    <a href="post.php" class="btn btn-custom-post btn-block">Post</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Questions/Posts --> 
            <div class="col-md-12 questions-feed">
            <?php
            include "../connection.php";
            if (!isset($_SESSION['username'])) {
                // Redirect to login page if the user is not logged in
                header("Location: ../Entry/login.php");
                exit;
            }

            // Fetch questions from the database
            $sql ="SELECT title, description, category, created_at, username, view, 'ask' AS type, NULL AS image
                FROM ask_tb
                UNION
                SELECT title, description, category, created_at, username, view, 'post' AS type, image
                FROM post_tb
                ORDER BY created_at DESC;
            ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $title = $row['title'];
                $description = $row['description'];
                $created_at = $row['created_at'];
                // Assuming a placeholder username and time for now
                $username = $row['username'];
                $type = $row['type'];
                $image = $row['image'];
                $view = $row['view'];
                if($view){
            
                echo '
                <div class="question-card mb-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">' . $title . '</h5>
                    </div>
                    <p class="card-text">' . $description . '</p>';
            
                if ($type === 'post' && $image) {
                    echo '<img src="../postimage/' . $image . '" class="card-img-top" alt="Post image">';
                }
            
                echo '
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-sm btn-link">Answers</button>
                            <button class="btn btn-sm btn-link">Upvote</button>
                            <button class="btn btn-sm btn-link">Share</button>
                        </div>
                        <small class="text-muted">Posted by ' . $username . ' - ' . $created_at . '</small>
                    </div>
                </div>';
            }
        }
            $conn->close();
            ?>
    </div>       
</div>
</div>


    <?php include "./footer.php"   ?>



</body>

</html>