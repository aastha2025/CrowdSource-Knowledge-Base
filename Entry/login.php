<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CKnowledge Base</title>
    <link rel="stylesheet" href="login.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close"></ion-icon></span>
        <div class="form-box login">
            <h2>Login</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="name">
                    <label>Username </label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon> </span>
                    <input type="password" name="pass">
                    <label>password</label>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox">Remember me
                    </label>
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't have an account?<a href="./registration.php" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php
// login backend
include("../connection.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_REQUEST['name'];
    $password = $_REQUEST['pass'];
    if (empty($uname) || empty($password)) {
        // echo "<script>alert('Fill up Everything'); window.location.href='login.php';</script>";
        echo '
            <div id="alertBox" class="alert alert-warning fade show" role="alert">
                <div id="slider"></div>
                <strong>Fill Up! </strong>Everything.
            </div>
            ';
        die();
    }
    else{
    $sql = "SELECT * FROM crowdsource WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) 
    {
       
        echo '
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>No User Found! </strong> Visit Registration.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                ';
        die();
    }
 
else{
    $row = $result->fetch_assoc();
    $passwordDB = $row['password'];
    $username = $row['name'];
    $role = $row['role'];
   
    if (password_verify($password, $row['password'])) 
       { 
        session_start();
        $_SESSION['username'] = $username;
        if ($role == 'admin') {
            header("Location: ../admin.php");
            exit();
        } else {
            header("Location: ../dash/index.php");
            exit();
        }
    } else {
          
        echo '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Wrong Password!</strong> try Again.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> ';
        die();
    }
}
}
}
?>