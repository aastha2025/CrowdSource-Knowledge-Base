<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKnowledge Base</title>
    <link rel="stylesheet" href="./ques.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Navbar -->
    <?php include "../dash/nav.php" ?>


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
                <!-- <div class="questions-feed"> -->
                    <!-- Example Question/Post -->
                    <div class="col-md-8 sidebar">
                    <div class="question-card">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">How does machine learning work?</h5>
                            <button class="btn btn-sm btn-outline-secondary">Follow</button>
                        </div>
                        <p class="card-text">Can someone explain how machine learning algorithms process data to make predictions?</p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button class="btn btn-sm btn-link">Answer</button>
                                <button class="btn btn-sm btn-link">Upvote</button>
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
                                <button class="btn btn-sm btn-link">Answer</button>
                                <button class="btn btn-sm btn-link">Upvote</button>
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
                                <button class="btn btn-sm btn-link">Answer</button>
                                <button class="btn btn-sm btn-link">Upvote</button>
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
                                <button class="btn btn-sm btn-link">Answer</button> 
                                <button class="btn btn-sm btn-link">Upvote</button>
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
                                <button class="btn btn-sm btn-link">Answer</button>
                                <button class="btn btn-sm btn-link">Upvote</button>
                                <button class="btn btn-sm btn-link">Share</button>
                            </div>
                            <small class="text-muted">Posted by User123 - 2 hours ago</small>
                        </div>
                    </div>              

                <div class="card-wrapper">
        <div class="card-container">
            <div class="card" data-category="AI">
                <img src="ai-image.jpg" alt="AI" class="card-img">
                <div class="card-content">
                    <h3>AI</h3>
                    <button class="card-button">View More</button>
                </div>
            </div>
            <div class="card" data-category="ML">
                <img src="ml-image.jpg" alt="Machine Learning" class="card-img">
                <div class="card-content">
                    <h3>Machine Learning</h3>
                    <button class="card-button">View More</button>
                </div>
            </div>
            <div class="card" data-category="IoT">
                <img src="iot-image.jpg" alt="IoT" class="card-img">
                <div class="card-content">
                    <h3>IoT</h3>
                    <button class="card-button">View More</button>
                </div>
            </div>
            <div class="card" data-category="DS">
                <img src="ds-image.jpg" alt="Data Science" class="card-img">
                <div class="card-content">
                    <h3>Data Science</h3>
                    <button class="card-button">View More</button>
                </div>
            </div>
            <!-- Add more cards as needed -->
        </div>
        <button class="scroll-button" id="scroll-right">→</button>
    </div>
    </div>
    </div>
            <!-- </div> -->
        </div>
    </div>

    <script>
        document.getElementById('scroll-right').addEventListener('click', () => {
    const container = document.querySelector('.card-container');
    container.scrollBy({
        left: 200, // Amount to scroll horizontally
        behavior: 'smooth'
    });
});

    </script>

    <!-- Footer
    <footer class="text-center mt-5 py-4">
        <p>&copy; 2024 Crowd Source Knowledge Base by Aastha Singh . All rights reserved.</p>
    </footer> -->

    <?php include "../dash/footer.php"   ?>



</body>

</html>