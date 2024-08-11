<?php
  session_start();

  if(!$_SESSION['username']) {
    header("Location: ../Entry/login.php");
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
    <link rel="stylesheet" href="./style.css">
    <!-- <link rel="stylesheet" href="../AdminDashboard/style.css"> -->
    <style>
        .profile-header {
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info label {
            font-weight: bold;
        }
        .profile-edit-btn {
            margin-top: 10px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <?php
        include "../connection.php";
        $sql = "SELECT * FROM crowdsource WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $email = $row['email'];
        $name = $row['name'];
        $role = $row['role'];
        $date = $row['created_at'];

    ?>

    <div class="container my mt-5">
        <h1 class="text-center"><span style="color: #06759A;"><?php echo $role ?></span></h1>
        <div class="profile-header text-center">
            <h2><?php echo $name ?></h2>
            <p class="text-muted"><?php echo $email ?></p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>Profile Information</h4>
                <div class="profile-info">
                    <p><label for="username">Username:</label> <?php echo $name ?></p>
                    <p><label for="email">Email:</label> <?php echo $email ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Update Profile</h4>
                <form action="setting.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="new-email">New Email:</label>
                        <input type="email" class="form-control" id="new-email" name="new_email">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input type="password" class="form-control" id="new-password" name="new_password">
                    </div>
                   
                    <button type="submit" class="btn btn-primary profile-edit-btn">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <?php
include "../connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE crowdsource SET email=? , password=? WHERE name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username , $email , $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>  Credencials  updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

} else {
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ERROR!</strong> Credencials updated Failed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
}
    ?>
</body>
</html>