<?php
include "../connection.php";
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login page if the user is not logged in
    header("Location: ../Entry/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Missing question ID");
}

$ques_id = $_GET['id'];
$user_id = $_SESSION['user_id']; // Assuming user ID is stored in the session

// Fetch the question details
$sql = "SELECT * FROM ask_tb WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ques_id);
$stmt->execute();
$question = $stmt->get_result()->fetch_assoc();

// Fetch answers for the question
$sql = "
    SELECT a.*, u.username 
    FROM ans_tb a 
    JOIN crowdsource u ON a.user_id = u.id 
    WHERE a.ques_id = ? 
    ORDER BY a.created_at DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ques_id);
$stmt->execute();
$answers = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['answer'])) {
        $answer = $_POST['answer'];

        // Insert the answer into the database
        $sql = "INSERT INTO ans_tb (ques_id, user_id, answer) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $ques_id, $user_id, $answer);

        if ($stmt->execute()) {
            header("Location: ans.php?id=$ques_id");
        } else {
            echo "ERROR: " . $stmt->error;
        }
    } else {
        echo "Answer cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answers</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .question {
            margin-bottom: 30px;
        }
        .answer-form textarea {
            width: 100%;
            margin-bottom: 20px;
        }
        .answer {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .answer-author {
            font-weight: bold;
        }
        .answer-actions {
            margin-top: 10px;
        }
        .answer-actions button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<?php include "../navbar.php"; ?>

<div class="container">
    <div class="question">
        <h2><?php echo $question['title']; ?></h2>
        <p><?php echo $question['description']; ?></p>
    </div>

    <div class="answer-form">
        <h3>Answer this question</h3>
        <form action="ans.php?id=<?php echo $ques_id; ?>" method="post">
            <textarea name="answer" rows="5" placeholder="Type your answer here..." required></textarea>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="answers">
        <h3>Answers</h3>
        <?php while ($answer = $answers->fetch_assoc()): ?>
            <div class="answer">
                <div class="answer-author"><?php echo $answer['username']; ?> (<?php echo $answer['created_at']; ?>)</div>
                <p><?php echo $answer['answer']; ?></p>
                <?php if ($answer['user_id'] == $user_id): ?>
                    <div class="answer-actions">
                        <a href="edit_answer.php?id=<?php echo $answer['id']; ?>" class="btn btn-secondary">Edit</a>
                        <a href="delete_answer.php?id=<?php echo $answer['id']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include "../footer.php"; ?>

</body>
</html>
