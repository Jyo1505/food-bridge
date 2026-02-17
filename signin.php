<?php
session_start();
include 'connection.php';
// $connection = mysqli_connect("localhost:3306", "root", "");
// $db = mysqli_select_db($connection, 'foodbridge');
 $msg=0;
if (isset($_POST['sign'])) {
  $email =mysqli_real_escape_string($connection, $_POST['email']);
  $password =mysqli_real_escape_string($connection, $_POST['password']);
 
  // $sanitized_emailid =  mysqli_real_escape_string($connection, $email);
  // $sanitized_password =  mysqli_real_escape_string($connection, $password);
  $sql = "select * from login where email='$email'";
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);
 
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['gender'] = $row['gender'];
        header("location:profile.php");
      } else {
        $msg = 1;
   
      }
    }
  } else {
    echo "<h1><center>Account does not exists </center></h1>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Bridge</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
        :root {
            --primary: #ff6b6b;
            --primary-dark: #ff5252;
            --secondary: #4ecdc4;
            --dark: #333;
            --gray: #666;
            --light-gray: #f5f5f5;
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .signup-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .signup-form {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .form-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 4rem 3rem;
            text-align: center;
        }
        
        .form-header h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        
        .form-header p {
            opacity: 0.9;
            font-size: 1.4rem;
        }
        
        .form-body {
            padding: 4rem 3rem;
        }
        
        .form-group {
            margin-bottom: 2.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 1rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 1.3rem;
        }
        
        .form-control {
            width: 100%;
            padding: 18px 24px;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            font-size: 1.2rem;
            transition: var(--transition);
        }
        
        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(255, 107, 107, 0.2);
        }
        
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 24px;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            font-size: 1.4rem;
        }
        
        .btn-submit {
            width: 100%;
            padding: 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1.4rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
        }
        
        .btn-submit:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.3);
        }
        
        .form-footer {
            text-align: center;
            margin-top: 3rem;
            color: var(--gray);
            font-size: 1.2rem;
        }
        
        .form-footer a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }
        
        .form-footer a:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 1.2rem 1.8rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .alert-danger {
            background: #fff5f5;
            color: #e53e3e;
            border: 1px solid #fed7d7;
            font-size: 1.1rem;
        }
        
        .alert i {
            font-size: 1.5rem;
        }
        
        .error-message {
            color: #e53e3e;
            font-size: 1rem;
            margin-top: 8px;
            display: none;
        }
        
        .error-icon {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            color: #e53e3e;
            font-size: 1.4rem;
        }
        
        /* Responsive adjustments */
        @media (min-width: 1600px) {
            .signup-form {
                max-width: 1400px;
            }
            .form-header {
                padding: 5rem 4rem;
            }
            .form-header h1 {
                font-size: 4rem;
            }
            .form-body {
                padding: 5rem 4rem;
            }
            .form-control {
                padding: 22px 28px;
                font-size: 1.3rem;
            }
            .btn-submit {
                padding: 24px;
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 1599px) {
            .signup-form {
                max-width: 1200px;
            }
            .form-header {
                padding: 4rem 3rem;
            }
            .form-header h1 {
                font-size: 3.5rem;
            }
            .form-body {
                padding: 4rem 3rem;
            }
            .form-control {
                padding: 18px 24px;
                font-size: 1.2rem;
            }
            .btn-submit {
                padding: 20px;
                font-size: 1.4rem;
            }
        }
        
        @media (max-width: 1199px) {
            .signup-form {
                max-width: 1000px;
            }
            .form-header {
                padding: 3.5rem 2.5rem;
            }
            .form-header h1 {
                font-size: 3rem;
            }
            .form-body {
                padding: 3.5rem 2.5rem;
            }
            .form-control {
                padding: 16px 22px;
                font-size: 1.1rem;
            }
            .btn-submit {
                padding: 18px;
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 991px) {
            .signup-form {
                max-width: 800px;
            }
            .form-header {
                padding: 3rem 2rem;
            }
            .form-header h1 {
                font-size: 2.8rem;
            }
            .form-body {
                padding: 3rem 2rem;
            }
            .form-control {
                padding: 15px 20px;
                font-size: 1rem;
            }
            .btn-submit {
                padding: 16px;
                font-size: 1.2rem;
            }
        }
        
        @media (max-width: 767px) {
            .signup-form {
                max-width: 100%;
                border-radius: 20px;
            }
            .form-header {
                padding: 2.5rem 1.5rem;
            }
            .form-header h1 {
                font-size: 2.4rem;
            }
            .form-body {
                padding: 2.5rem 1.5rem;
            }
            .form-control {
                padding: 14px 18px;
                font-size: 1rem;
            }
            .btn-submit {
                padding: 16px;
                font-size: 1.1rem;
            }
        }
        
        @media (max-width: 575px) {
            .signup-container {
                padding: 1rem;
            }
            .form-header {
                padding: 2rem 1rem;
            }
            .form-header h1 {
                font-size: 2rem;
            }
            .form-body {
                padding: 2rem 1rem;
            }
            .form-control {
                padding: 12px 16px;
                font-size: 0.95rem;
            }
            .btn-submit {
                padding: 14px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container" data-aos="fade-up">
        <div class="signup-form">
            <div class="form-header">
                <h1>FoodBridge</h1>
                <p>Welcome back!</p>
            </div>
            
            <div class="form-body">
                <?php if(isset($msg) && $msg == 1) { ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Incorrect password. Please try again.</span>
                    </div>
                <?php } ?>
                
                <form action="" method="post" id="loginForm">
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                        <div id="email-error" class="error-message">Please enter a valid email address</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="uil uil-eye-slash" id="toggle-icon"></i>
                            </button>
                            <?php if($msg == 1) { ?>
                                <i class="bx bx-error-circle error-icon"></i>
                            <?php } ?>
                        </div>
                        <?php if($msg == 1) { ?>
                            <div class="error-message" style="display: block;">Password doesn't match.</div>
                        <?php } else { ?>
                            <div id="password-error" class="error-message">Please enter your password</div>
                        <?php } ?>
                    </div>
                    
                    <button type="submit" name="sign" class="btn-submit">Sign In</button>
                </form>
                
                <div class="form-footer">
                    <p>Don't have an account? <a href="signup.php">Register</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
        
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggle-icon");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("uil-eye-slash");
                toggleIcon.classList.add("uil-eye");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("uil-eye");
                toggleIcon.classList.add("uil-eye-slash");
            }
        }
        
        // Email validation with specific domain checking
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        
        function validateEmail() {
            const email = emailInput.value.trim();
            // Regex to check for specific email providers
            const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|hotmail\.com|icloud\.com)$/;
            
            if (!emailRegex.test(email)) {
                emailError.style.display = 'block';
                emailInput.style.borderColor = '#e53e3e';
                return false;
            } else {
                emailError.style.display = 'none';
                emailInput.style.borderColor = '#e0e0e0';
                return true;
            }
        }
        
        emailInput.addEventListener('blur', validateEmail);
        
        // Password validation
        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('password-error');
        
        function validatePassword() {
            const password = passwordInput.value.trim();
            
            if (password.length === 0) {
                passwordError.style.display = 'block';
                passwordInput.style.borderColor = '#e53e3e';
                return false;
            } else {
                passwordError.style.display = 'none';
                passwordInput.style.borderColor = '#e0e0e0';
                return true;
            }
        }
        
        passwordInput.addEventListener('input', validatePassword);
        
        // Form submission validation
        const loginForm = document.getElementById('loginForm');
        
        loginForm.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validate all fields
            if (!validateEmail()) {
                isValid = false;
            }
            
            if (!validatePassword()) {
                isValid = false;
            }
            
            if (!isValid) {
                event.preventDefault();
                
                // Scroll to the first error
                const firstError = document.querySelector('.error-message[style="display: block;"]');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    </script>
</body>
</html>