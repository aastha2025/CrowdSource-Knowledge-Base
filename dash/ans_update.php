<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
</head>
<body>
<?php include "nav.php"; ?>
<?php
include "../connection.php";
// session_start();

if(!$_SESSION['username']){
    header('location: ../Entry/login.php');
}
$username=$_SESSION['username'];
$id = $_REQUEST['id'];


$sql = "SELECT * FROM ans_tb WHERE id=? AND username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id , $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Answer not found.");
}

$row = $result->fetch_assoc();
$answer = $row['answer'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['answer'])){
    $new_ans = $_POST['answer'];

    $sql = "UPDATE ans_tb SET answer=? WHERE id=? AND username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis",  $new_ans, $id, $username);
    if ($stmt->execute()) {
        echo '
            <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                <strong>Success!</strong> Answer updated successfully...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>window.open("./index.php","_self")</script>
        ';
        // header('location: answer.php');
    } else {
        echo '
            <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                <strong>Error!</strong> Something went wrong...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
    }
}
}

?>

<div class="container my-5">
    <h1 class="text-center mb-4">Update Answer</h1>

    <form method="post" action="">
        <div class="mb-3">
            <label class="form-label">Answer:</label>
            <textarea class="form-control"  name="answer" ><?php echo $answer; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Answer</button>
    </form>
</div>
</body>
</html>