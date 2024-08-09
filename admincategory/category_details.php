<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles.css">
</head>
<style>
    hr {
        border: dotted black 6px;
        border-bottom: none;
        width: 4%;
        margin: 100px auto;
    }
</style>

<body>

    <?php
    include "../connection.php";
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM category WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <div class="container mt-4">
        <?php
        $row = $result->fetch_assoc();
        $name = $row["name"];
        echo '
    <h1 class="text-center mb-3">' . $row['name'] . '</h1>
        <div class="row">
            <div class="col md-2">

            <img class="image" src="../images/' . $row['image'] . '" alt="human Knowledge" height="250px" width="350px">

            </div>

            <div class="col md-10">
                <p>' . $row['description'] . ' </p>
            </div>
        </div>

        ';
        ?>
    </div>

    <hr>
    <h1 class="text-center">Question related to <span style="color: #06759A;"> <?php echo $name ?> </span> </h1>
    <div class="container">
    <div class="col-md-12 questions-feed">
        <?php


        // Fetch questions from the database
        $sql = "(
            SELECT title, description, category, created_at, username, 'ask' AS type, NULL AS image
            FROM ask_tb
            WHERE category = ?
        )
        UNION ALL
        (
            SELECT title, description, category, created_at, username, 'post' AS type, image
            FROM post_tb
            WHERE category = ?
        )
        ORDER BY created_at DESC";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("ss", $name, $name);
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

            echo '
            <div class="question-card mb-3">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">' . $title . '</h5>
                    <button class="btn btn-sm btn-outline-secondary">Follow</button>
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


        $conn->close();
        ?>
    </div>
    </div>
</body>

</html>