<?php
include 'connection.php';

if (isset($_POST['sign'])) {
    $username = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $terms = isset($_POST['terms']) ? 1 : 0;
    $phone = trim($_POST['number']);

    // Validation
    if (!$terms) {
        $error = "You must agree to the terms and conditions";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $username)) {
        $error = "Name must contain only letters and spaces (no numbers or special characters)";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|hotmail\.com|icloud\.com)$/", $email)) {
        $error = "Email must be from a valid provider (e.g., gmail.com, yahoo.com, outlook.com, etc.)";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "Phone number must be exactly 10 digits";
    } else {
        $pass = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM login WHERE email='$email'";
        $result = mysqli_query($connection, $sql);
        $num = mysqli_num_rows($result);

        if ($num == 1) {
            $error = "Account already exists. <a href='signin.php'>Sign in instead</a>";
        } else {
            $query = "INSERT INTO login(name, email, password, gender, phone) 
                      VALUES('$username', '$email', '$pass', '$gender', '$phone')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                header("location:signin.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Food Bridge</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #ff6b6b;
            --primary-dark: #ee5a52;
            --secondary: #4ecdc4;
            --dark: #2d3436;
            --gray: #636e72;
            --light: #dfe6e9;
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
        
        .password-strength {
            margin-top: 0.8rem;
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .password-strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
            border-radius: 4px;
        }
        
        .strength-weak {
            width: 33%;
            background: #ff4757;
        }
        
        .strength-medium {
            width: 66%;
            background: #ffa502;
        }
        
        .strength-strong {
            width: 100%;
            background: #2ed573;
        }
        
        .password-strength-text {
            margin-top: 0.5rem;
            font-size: 1rem;
            color: var(--gray);
        }
        
        .radio-group {
            display: flex;
            gap: 3rem;
            margin-top: 1rem;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
        }
        
        .radio-option input {
            margin-right: 1rem;
            transform: scale(1.5);
        }
        
        .radio-option label {
            font-weight: 500;
            font-size: 1.3rem;
        }
        
        .terms-group {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }
        
        .terms-group input {
            margin-top: 0.3rem;
            transform: scale(1.4);
        }
        
        .terms-group label {
            font-size: 1.1rem;
            color: var(--gray);
            line-height: 1.6;
        }
        
        .terms-group a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .terms-group a:hover {
            text-decoration: underline;
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
        
        .social-signup {
            margin-top: 3rem;
            text-align: center;
        }
        
        .social-signup p {
            color: var(--gray);
            margin-bottom: 1.5rem;
            position: relative;
            font-size: 1.1rem;
        }
        
        .social-signup p::before,
        .social-signup p::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #e0e0e0;
        }
        
        .social-signup p::before {
            left: 0;
        }
        
        .social-signup p::after {
            right: 0;
        }
        
        .social-buttons {
            display: flex;
            gap: 1.5rem;
        }
        
        .social-btn {
            flex: 1;
            padding: 16px;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            font-size: 1.1rem;
        }
        
        .social-btn:hover {
            border-color: var(--primary);
            transform: translateY(-4px);
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
            .radio-group {
                gap: 2rem;
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
            .radio-group {
                gap: 1.5rem;
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
            .radio-group {
                flex-direction: column;
                gap: 1rem;
            }
            .social-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container" data-aos="fade-up">
        <div class="signup-form">
            <div class="form-header">
                <h1>FoodBridge</h1>
                <p>Create your account</p>
            </div>
            
            <div class="form-body">
                <?php if(isset($error)) { ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo $error; ?></span>
                    </div>
                <?php } ?>
                
                <form action="" method="post" id="signupForm">
                    <div class="form-group">
                        <label class="form-label" for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                        <div id="name-error" class="error-message">Name must contain only letters and spaces</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                        <div id="email-error" class="error-message">Please use a valid email provider (gmail.com, yahoo.com, outlook.com, etc.)</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggle-icon"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-meter" id="strength-meter"></div>
                        </div>
                        <div class="password-strength-text" id="strength-text">Enter a password</div>
                        <div id="password-error" class="error-message">Password must be at least 8 characters with uppercase, lowercase, number, and special character</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="confirm_password">Confirm Password</label>
                        <div class="password-container">
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm your password" required>
                            <button type="button" class="password-toggle" onclick="toggleConfirmPassword()">
                                <i class="fas fa-eye" id="toggle-confirm-icon"></i>
                            </button>
                        </div>
                        <div id="confirm-password-error" class="error-message">Passwords do not match</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="number">Phone Number</label>
                        <input type="tel" id="number" name="number" class="form-control" placeholder="Enter your 10-digit phone number" required>
                        <div id="phone-error" class="error-message">Phone number must be exactly 10 digits</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Gender</label>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" id="male" name="gender" value="male" required>
                                <label for="male">Male</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="female" name="gender" value="female">
                                <label for="female">Female</label>
                            </div>
                        </div>
                        <div id="gender-error" class="error-message">Please select your gender</div>
                    </div>
                    
                    <div class="terms-group">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    <div id="terms-error" class="error-message">You must agree to the terms and conditions</div>
                    
                    <button type="submit" name="sign" class="btn-submit">Create Account</button>
                </form>
                
                <div class="form-footer">
                    <p>Already have an account? <a href="signin.php">Sign In</a></p>
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
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
        
        function toggleConfirmPassword() {
            const confirmPasswordInput = document.getElementById("confirm_password");
            const toggleIcon = document.getElementById("toggle-confirm-icon");
            
            if (confirmPasswordInput.type === "password") {
                confirmPasswordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                confirmPasswordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
        
        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthMeter = document.getElementById('strength-meter');
        const strengthText = document.getElementById('strength-text');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;
            
            strengthMeter.className = 'password-strength-meter';
            
            if (strength <= 2) {
                strengthMeter.classList.add('strength-weak');
                strengthText.textContent = 'Weak password';
                strengthText.style.color = '#ff4757';
            } else if (strength <= 4) {
                strengthMeter.classList.add('strength-medium');
                strengthText.textContent = 'Medium password';
                strengthText.style.color = '#ffa502';
            } else {
                strengthMeter.classList.add('strength-strong');
                strengthText.textContent = 'Strong password';
                strengthText.style.color = '#2ed573';
            }
        });
        
        // Name validation - only letters and spaces
        const nameInput = document.getElementById('name');
        const nameError = document.getElementById('name-error');
        
        function validateName() {
            const name = nameInput.value.trim();
            const nameRegex = /^[a-zA-Z ]+$/;
            
            if (!nameRegex.test(name) || name.length < 2) {
                nameError.style.display = 'block';
                nameInput.style.borderColor = '#e53e3e';
                return false;
            } else {
                nameError.style.display = 'none';
                nameInput.style.borderColor = '#e0e0e0';
                return true;
            }
        }
        
        nameInput.addEventListener('input', validateName);
        
        // Email validation
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        
        function validateEmail() {
            const email = emailInput.value.trim();
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
        const passwordError = document.getElementById('password-error');
        
        function validatePassword() {
            const password = passwordInput.value;
            
            if (password.length < 8 || 
                !password.match(/[a-z]+/) || 
                !password.match(/[A-Z]+/) || 
                !password.match(/[0-9]+/) || 
                !password.match(/[$@#&!]+/)) {
                passwordError.style.display = 'block';
                passwordInput.style.borderColor = '#e53e3e';
                return false;
            } else {
                passwordError.style.display = 'none';
                passwordInput.style.borderColor = '#e0e0e0';
                return true;
            }
        }
        
        passwordInput.addEventListener('input', function() {
            validatePassword();
            // Also validate confirm password if it has a value
            if (confirmPasswordInput.value) {
                validateConfirmPassword();
            }
        });
        
        // Confirm password validation
        const confirmPasswordInput = document.getElementById('confirm_password');
        const confirmPasswordError = document.getElementById('confirm-password-error');
        
        function validateConfirmPassword() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            if (password !== confirmPassword) {
                confirmPasswordError.style.display = 'block';
                confirmPasswordInput.style.borderColor = '#e53e3e';
                return false;
            } else {
                confirmPasswordError.style.display = 'none';
                confirmPasswordInput.style.borderColor = '#e0e0e0';
                return true;
            }
        }
        
        confirmPasswordInput.addEventListener('input', validateConfirmPassword);
        
        // Phone number validation - only digits, exactly 10
        const phoneInput = document.getElementById('number');
        const phoneError = document.getElementById('phone-error');
        
        function validatePhone() {
            const phone = phoneInput.value.trim();
            const phoneRegex = /^[0-9]{10}$/;
            
            if (!phoneRegex.test(phone)) {
                phoneError.style.display = 'block';
                phoneInput.style.borderColor = '#e53e3e';
                return false;
            } else {
                phoneError.style.display = 'none';
                phoneInput.style.borderColor = '#e0e0e0';
                return true;
            }
        }
        
        // Only allow numbers in phone input
        phoneInput.addEventListener('input', function() {
            // Remove any non-digit characters
            this.value = this.value.replace(/\D/g, '');
            // Limit to 10 digits
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
            validatePhone();
        });
        
        // Gender validation
        const genderError = document.getElementById('gender-error');
        
        function validateGender() {
            const maleRadio = document.getElementById('male');
            const femaleRadio = document.getElementById('female');
            
            if (!maleRadio.checked && !femaleRadio.checked) {
                genderError.style.display = 'block';
                return false;
            } else {
                genderError.style.display = 'none';
                return true;
            }
        }
        
        // Terms validation
        const termsCheckbox = document.getElementById('terms');
        const termsError = document.getElementById('terms-error');
        
        function validateTerms() {
            if (!termsCheckbox.checked) {
                termsError.style.display = 'block';
                return false;
            } else {
                termsError.style.display = 'none';
                return true;
            }
        }
        
        termsCheckbox.addEventListener('change', validateTerms);
        
        // Form submission validation
        const signupForm = document.getElementById('signupForm');
        
        signupForm.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validate all fields
            if (!validateName()) {
                isValid = false;
            }
            
            if (!validateEmail()) {
                isValid = false;
            }
            
            if (!validatePassword()) {
                isValid = false;
            }
            
            if (!validateConfirmPassword()) {
                isValid = false;
            }
            
            if (!validatePhone()) {
                isValid = false;
            }
            
            if (!validateGender()) {
                isValid = false;
            }
            
            if (!validateTerms()) {
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