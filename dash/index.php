<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKnowledge Base</title>
    <link rel="stylesheet" href="../home page/styles.css">
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
                    <li class="list-group-item"><a href="#">Machine Learning</a></li>
                    <li class="list-group-item"><a href="#">Artificial Intelligence</a></li>
                    <li class="list-group-item"><a href="#">Data Science</a></li>
                    <!-- Add more related topics as needed -->
                </ul>
            </div>

            <!-- Ask a Question and Questions/Posts -->
            <div class="col-md-8 questions-feed">
                <!-- Ask a Question -->
                <div class="ask-question ">
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


                        <!--  <button type="submit" class="btn btn-primary">Submit</button>-->
                    </form>
                </div>

                <!-- Questions/Posts -->
                <!-- <div class="questions-feed"> -->
                    <!-- Example Question/Post -->
                    <div class="question-card">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">How does machine learning work?</h5>
                            <button class="btn btn-sm btn-outline-secondary">Follow</button>
                        </div>
                        <p class="card-text">Can someone explain how machine learning algorithms process data to make predictions?</p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button class="btn btn-sm btn-link">Upvote</button>
                                <button class="btn btn-sm btn-link">Comment</button>
                                <button class="btn btn-sm btn-link">Share</button>
                            </div>
                            <small class="text-muted">Posted by User123 - 2 hours ago</small>
                        </div>
                    </div>
                    <!-- Repeat similar blocks for more questions/posts -->
                    <div class="question-card">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">How does machine learning work?</h5>
                            <button class="btn btn-sm btn-outline-secondary">Follow</button>
                        </div>
                        <p class="card-text">Can someone explain how machine learning algorithms process data to make predictions?</p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button class="btn btn-sm btn-link">Upvote</button>
                                <button class="btn btn-sm btn-link">Comment</button>
                                <button class="btn btn-sm btn-link">Share</button>
                            </div>
                            <small class="text-muted">Posted by User123 - 2 hours ago</small>
                        </div>
                    </div>

                    <div class="question-card">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">How does machine learning work?</h5>
                            <button class="btn btn-sm btn-outline-secondary">Follow</button>
                        </div>
                        <p class="card-text">Can someone explain how machine learning algorithms process data to make predictions?</p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button class="btn btn-sm btn-link">Upvote</button>
                                <button class="btn btn-sm btn-link">Comment</button>
                                <button class="btn btn-sm btn-link">Share</button>
                            </div>
                            <small class="text-muted">Posted by User123 - 2 hours ago</small>
                        </div>
                    </div>

                    <div class="question-card">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">How does machine learning work?</h5>
                            <button class="btn btn-sm btn-outline-secondary">Follow</button>
                        </div>
                        <p class="card-text">Can someone explain how machine learning algorithms process data to make predictions?</p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button class="btn btn-sm btn-link">Upvote</button>
                                <button class="btn btn-sm btn-link">Comment</button>
                                <button class="btn btn-sm btn-link">Share</button>
                            </div>
                            <small class="text-muted">Posted by User123 - 2 hours ago</small>
                        </div>
                    </div>

                    <div class="question-card">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">How does machine learning work?</h5>
                            <button class="btn btn-sm btn-outline-secondary">Follow</button>
                        </div>
                        <p class="card-text">Can someone explain how machine learning algorithms process data to make predictions?</p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button class="btn btn-sm btn-link">Upvote</button>
                                <button class="btn btn-sm btn-link">Comment</button>
                                <button class="btn btn-sm btn-link">Share</button>
                            </div>
                            <small class="text-muted">Posted by User123 - 2 hours ago</small>
                        </div>
                    </div>

                <!-- </div> -->
            </div>
        </div>
    </div>

    <!-- Footer
    <footer class="text-center mt-5 py-4">
        <p>&copy; 2024 Crowd Source Knowledge Base by Aastha Singh . All rights reserved.</p>
    </footer> -->

    <?php include "./footer.php"   ?>



</body>

</html>