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
        <div class="form-box register">
            <h2>Registration</h2>
            <form id="registrationForm" method="post" action="">

            <div class="input-box">
                 <span class="icon">
                 <ion-icon name="person"></ion-icon> </span>  
                 <input  type="text"id="name" name="name">
                 <label for="name">Name</label>    
              </div>

                <div class="input-box">
                 <span class="icon">
                 <ion-icon name="mail"></ion-icon>
                 </span>  
                 <input type="email" id="email" name="email">
                 <label for="email">Email </label>    
              </div>

              <div class="input-box">
                 <span class="icon">
                 <ion-icon name="lock-closed"></ion-icon>
                </span>  
                 <input type="password"  id="password" name="password">
                 <label for="password">password</label>    
             </div>            
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox">I agree to the terms & conditions
                    </label>
                </div>
                <button type="submit" class="btn">Register</button>
               <div class="login-register">
                <p>Already have an account?<a href="./login.php" class="register-link">Login</a></p>
               </div>
            </form>
        </div>
    </div>

</body>
</html>
    
<?php
// Include database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../connection.php');
    // Retrieve and sanitize input data
    $name = $_REQUEST['name'];
    $email =$_REQUEST['email'];
    $password = $_REQUEST['password'];

    // Validate input data
    if (empty($name) || empty($email) || empty($password)) {
        echo '
        <div class="alert alert-warning alert-dismissible fade show m-4" role="alert">
      <strong>ALERT!</strong> One or more fields are empty....
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
        ';
       
    } else {
        // Check if email is already registered
        $sql = "SELECT id FROM crowdsource WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo'
       
            <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
          <strong>Sorry!</strong> User already Registered....
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
            ';
        } else {
            // Insert new user into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $role = 'user'; // Default role for new registrations
            $createdAt = date('Y-m-d H:i:s'); // Current date and time

            $sql = "INSERT INTO crowdsource (name, email, password, role, created_at) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $name, $email, $hashedPassword, $role, $createdAt);

            if ($stmt->execute()) {
                // Registration successful, redirect to dashboard
                header("Location: ./login.php");
                exit();
            } else {
                $error = "Error: " . $stmt->error;
            }
        }
    

        $stmt->close();
    }

    $conn->close();
}
?>