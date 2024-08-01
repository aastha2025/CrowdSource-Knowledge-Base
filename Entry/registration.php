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
            <form action="">

            <div class="input-box">
                 <span class="icon">
                 <ion-icon name="person"></ion-icon> </span>  
                 <input type="text" required>
                 <label>Name</label>    
              </div>

                <div class="input-box">
                 <span class="icon">
                 <ion-icon name="mail"></ion-icon>
                 </span>  
                 <input type="email" required>
                 <label >Email </label>    
              </div>

              <div class="input-box">
                 <span class="icon">
                 <ion-icon name="lock-closed"></ion-icon>                 </span>  
                 <input type="password" required>
                 <label >password</label>    
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
