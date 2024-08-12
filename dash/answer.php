<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions - CrowdSource</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        .question-card {
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .question-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .question-card .card-title {
            color: #007bff;
            font-size: 1.25rem;
        }
        .question-card .card-text {
            font-size: 1rem;
            color: #495057;
        }
        .question-card .text-muted {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php
    include "../connection.php";
    // session_start();


    $username = $_SESSION['username'];
    $id = $_REQUEST['id'];

    // Fetch the question details
    $sql = "SELECT * FROM ask_tb WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <div class="container my-5">
        <h1 class="text-center mb-4">Question</h1>

        <?php if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ques_id = $row["id"];
                echo '
                <div class="question-card mb-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">' . $row['title'] . '</h5>
                    </div>
                    <p class="card-text">' . $row['description'] . '</p>';
                    echo '
                    <small class="text-muted">Posted by ' . $row['username'] . ' - ' . $row['created_at'] . '</small>';
            }
        }
        ?>

        <div class="container mt-3">
            <h1 class="text-center">Answer this Question</h1>
            <form id="askForm" method="post" action="">
                <label class="form-label">Answer:</label>
                <textarea class="form-control" name="answer"></textarea>
                <input class="btn btn-success mt-3 w-100" type="submit" value="Submit Answer">
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_REQUEST['answer'])) {
            $sql = "INSERT INTO ans_tb (ques_id, answer, username) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $ques_id, $_REQUEST['answer'], $username);
            if ($stmt->execute()) {
                echo '
                    <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                        <strong>Congrats!</strong> Answer Submitted Successfully...
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
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

    $sql = "SELECT * FROM ans_tb WHERE ques_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $answer = $row['answer'];
        $created_at = $row['created_at'];
        $answer_user = $row['username'];

        echo '
            <div class="container mt-3 mb-3">
                <p class="card-text">' . $answer . '</p>
                <small class="text-muted">Posted by ' . $answer_user . ' - ' . $created_at . '</small>';

        if ($answer_user === $username) {
            echo '
                <a href="ans_update.php?id=' . $row['id'] . '&type=ans" class="btn btn-warning">Update</a>
                <a href="ans_delete.php?id=' . $row['id'] . '&type=ans" class="btn btn-danger">Delete</a>
            ';
        }
        echo '</div>';
        echo '<hr>';
    }
    ?>
</body>
</html>
