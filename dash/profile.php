<?php
session_start();
include "../connection.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../Entry/login.php");
    exit();
}

// Fetch user data
$username = $_SESSION['username'];
$sql = "SELECT * FROM crowdsource WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user_profile = $result->fetch_assoc();

if (!$user_profile) {
    echo "User profile not found.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .profile-header {
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .btn-settings {
            margin-top: 10px;
        }
        .update-form {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .update-form textarea,
        .update-form input {
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php include "nav.php"; ?>

    <div class="container my-5">
        <h1 class="text-center">Profile</h1>
        <div class="profile-header">
            <h2><span style="color: #06759A;"><?php echo $user_profile['name']; ?></span></h2>
            <p class="text-muted"><?php echo $user_profile['email']; ?></p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>Personal Information</h4>
                <div class="profile-info">
                    <p><strong>Username:</strong> <?php echo $user_profile['name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user_profile['email']; ?></p>
                    <p><strong>About:</strong> <?php echo $user_profile['about']; ?></p>
                    <p><strong>Tech Stack:</strong> <?php echo $user_profile['tech_stack']; ?></p>
                    <p><strong>Interests:</strong> <?php echo $user_profile['interests']; ?></p>
                </div>
                <a href="setting.php" class="btn btn-primary btn-settings">Settings</a>
                <a href="../Entry/logout.php" class="btn btn-secondary btn-settings">Logout</a>
            </div>

            <?php
include "../connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $about = $_POST['about'];
    $tech_stack = $_POST['tech_stack'];
    $interests = $_POST['interests'];

    $sql = "UPDATE crowdsource SET about = ?, tech_stack = ?, interests = ? WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $about, $tech_stack, $interests, $username);

    if ($stmt->execute()) {
        echo '
        <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
            <strong>Congrats!</strong> Profile Updated  Successfully...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';

        exit();
    } else {
        echo "Error updating profile: " . $stmt->error;
    }
}
?>

            <div class="col-md-6">
                <h4>Update Profile</h4>
                <form action="profile.php" method="post">
                    <div class="form-group">
                        <label for="about">About:</label>
                        <textarea class="form-control" id="about" name="about"><?php echo $user_profile['about']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tech_stack">Tech Stack:</label>
                        <input type="text" class="form-control" id="tech_stack" name="tech_stack" value="<?php $user_profile['tech_stack']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="interests">Interests:</label>
                        <input type="text" class="form-control" id="interests" name="interests" value="<?php echo $user_profile['interests']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
            </div>
        </div>
    </div>

</body>
</html>
