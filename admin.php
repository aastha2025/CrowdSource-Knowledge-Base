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
     <?php include "adminnav.php" ?>


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
                            <p class="form-control" name="question" >What you want to share?</p>
                        </div>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <a href="./admin_post_ques/ask.php" class="btn btn-custom-ask btn-block">Ask</a>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <a href="./admin_post_ques/post.php" class="btn btn-custom-post btn-block">Post</a>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                <button type="button" class="btn btn-primary" id="questionsButton">Questions for You</button>
                                </div>
                                <div class="col-md-6 mb-2">
                                <button type="button" class="btn btn-secondary" id="postsButton">Posts for You</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Questions/Posts --> 
            <div class="col-md-12 questions-feed">
        <div id="content">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>       
</div>
</div>


    <?php include "footer.php"   ?>



</body>
<script>

document.getElementById('questionsButton').addEventListener('click', function () {
            fetch('admin_fetch_data.php?type=ask')
                .then(response => response.text())
                .then(data => document.getElementById('content').innerHTML = data);
        });

        document.getElementById('postsButton').addEventListener('click', function () {
            fetch('admin_fetch_data.php?type=post')
                .then(response => response.text())
                .then(data => document.getElementById('content').innerHTML = data);
        });

</script>

</html>