<?php
include("login.php"); 
if($_SESSION['name']==''){
	header("location: signin.php");
}
// include("login.php"); 
$emailid= $_SESSION['email'];
$connection=mysqli_connect("localhost","root","152005");
$db=mysqli_select_db($connection,'foodbridge');
if(isset($_POST['submit']))
{
    $foodname=mysqli_real_escape_string($connection, $_POST['foodname']);
    $meal=mysqli_real_escape_string($connection, $_POST['meal']);
    $category=$_POST['image-choice'];
    $quantity=mysqli_real_escape_string($connection, $_POST['quantity']);
    // $email=$_POST['email'];
    $phoneno=mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district=mysqli_real_escape_string($connection, $_POST['district']);
    $address=mysqli_real_escape_string($connection, $_POST['address']);
    $name=mysqli_real_escape_string($connection, $_POST['name']);
  

 



    $query="insert into food_donations(email,food,type,category,phoneno,location,address,name,quantity) values('$emailid','$foodname','$meal','$category','$phoneno','$district','$address','$name','$quantity')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {

        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:delivery.html");
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodBridge</title>
    <link rel="stylesheet" href="fooddonate.css">
    <style>
        /* Reset and Base Styles */
/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

:root {
    --primary: #06C167;
    --primary-dark: #059F56;
    --primary-light: #7EDAAF;
    --secondary: #4ECDC4;
    --secondary-dark: #3DBCB3;
    --accent: #FF6B6B;
    --accent-light: #FF8E8E;
    --dark: #1A202C;
    --dark-light: #2D3748;
    --light: #F7FAFC;
    --light-gray: #E2E8F0;
    --gray: #718096;
    --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
    --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    --shadow-md: 0 10px 15px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 20px 25px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    --radius: 12px;
    --radius-lg: 16px;
}

body {
    background: linear-gradient(135deg, #f8fafc 0%, #e6fffa 50%, #f0fdf4 100%);
    min-height: 100vh;
    color: var(--dark);
    line-height: 1.6;
    position: relative;
    overflow-x: hidden;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDYwIDYwIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzR2LTRoLTR2NGgtNHY0aDR2NGg0di00aDR2LTRoLTR2LTRoLTR2NGgtNHY0aDR2NGg0di00aDR2LTRoLTR2LTRoLTR2NGgtNHY0aDR6Ii8+PC9nPjwvZz48L3N2Zz4=');
    opacity: 0.5;
    z-index: -1;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    position: relative;
    z-index: 1;
}

/* Header Styles */
header {
    text-align: center;
    margin-bottom: 40px;
    padding: 30px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
}

.logo {
    font-size: 2.8rem;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 8px;
    letter-spacing: -0.5px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.tagline {
    color: var(--gray);
    font-size: 1.1rem;
    font-weight: 500;
    letter-spacing: 0.5px;
}

/* Form Container */
.regformf {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.form-container {
    padding: 40px;
}

/* Form Sections */
.form-section {
    margin-bottom: 50px;
    position: relative;
}

.form-section::after {
    content: '';
    position: absolute;
    bottom: -25px;
    left: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, var(--light-gray) 50%, transparent 100%);
}

.form-section:last-child::after {
    display: none;
}

.section-title, .contact-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--light-gray);
    position: relative;
    display: inline-block;
}

.section-title::after, .contact-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    border-radius: 2px;
}

/* Input Group Styles */
.input-group {
    margin-bottom: 25px;
    position: relative;
}

.input-group label {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
    color: var(--dark-light);
    font-size: 0.95rem;
    letter-spacing: 0.3px;
}

.required::after {
    content: ' *';
    color: var(--accent);
    margin-left: 2px;
}

.input-group input, 
.input-group select {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid var(--light-gray);
    border-radius: var(--radius);
    font-size: 1rem;
    transition: var(--transition);
    background: var(--light);
    color: var(--dark);
    font-weight: 500;
}

.input-group input:focus, 
.input-group select:focus {
    outline: none;
    border-color: var(--primary);
    background: white;
    box-shadow: 0 0 0 4px rgba(6, 193, 103, 0.1);
    transform: translateY(-2px);
}

.input-group input::placeholder {
    color: var(--gray);
    font-weight: 400;
}

/* Radio Button Styles */
.radio-group {
    display: flex;
    gap: 25px;
    margin-top: 10px;
}

.radio-option {
    display: flex;
    align-items: center;
    position: relative;
    cursor: pointer;
}

.radio-option input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.radio-option label {
    position: relative;
    padding-left: 30px;
    cursor: pointer;
    font-weight: 500;
    color: var(--dark-light);
    transition: var(--transition);
}

.radio-option label::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    border: 2px solid var(--light-gray);
    border-radius: 50%;
    background: white;
    transition: var(--transition);
}

.radio-option input:checked + label::before {
    border-color: var(--primary);
    background: var(--primary);
}

.radio-option input:checked + label::after {
    content: '';
    position: absolute;
    left: 7px;
    top: 50%;
    transform: translateY(-50%);
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: white;
}

/* Image Radio Group */
.image-radio-group {
    display: flex;
    gap: 20px;
    margin-top: 15px;
    flex-wrap: wrap;
}

.image-radio-group input[type="radio"] {
    display: none;
}

.image-radio-group label {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 120px;
    padding: 15px;
    border: 2px solid var(--light-gray);
    border-radius: var(--radius);
    cursor: pointer;
    transition: var(--transition);
    text-align: center;
    background: white;
    position: relative;
    overflow: hidden;
}

.image-radio-group label::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(6, 193, 103, 0.1) 0%, rgba(78, 205, 196, 0.1) 100%);
    opacity: 0;
    transition: var(--transition);
}

.image-radio-group label img {
    width: 60px;
    height: 60px;
    margin-bottom: 12px;
    transition: var(--transition);
}

.image-radio-group label div {
    font-size: 0.95rem;
    color: var(--dark-light);
    font-weight: 500;
    transition: var(--transition);
}

.image-radio-group input[type="radio"]:checked + label {
    border-color: var(--primary);
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.image-radio-group input[type="radio"]:checked + label::before {
    opacity: 1;
}

.image-radio-group input[type="radio"]:checked + label img {
    transform: scale(1.1);
}

.image-radio-group input[type="radio"]:checked + label div {
    color: var(--primary);
    font-weight: 600;
}

/* Map Section */
.map-container {
    position: relative;
    height: 450px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 2px solid var(--light-gray);
    margin-bottom: 20px;
    box-shadow: var(--shadow);
}

#map {
    height: 100%;
    width: 100%;
}

.map-marker-instruction {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 12px 16px;
    border-radius: var(--radius);
    font-size: 0.9rem;
    z-index: 1000;
    box-shadow: var(--shadow-md);
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    color: var(--dark-light);
}

.map-marker-instruction i {
    color: var(--primary);
}

.search-box {
    position: absolute;
    top: 15px;
    right: 15px;
    display: flex;
    z-index: 1000;
    box-shadow: var(--shadow-md);
    border-radius: var(--radius);
    overflow: hidden;
}

.search-box input {
    width: 250px;
    padding: 12px 16px;
    border: none;
    border-radius: 0;
    background: white;
    color: var(--dark);
    font-weight: 500;
}

.search-box input:focus {
    outline: none;
    box-shadow: none;
}

.search-box button {
    padding: 12px 16px;
    background: var(--primary);
    color: white;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-box button:hover {
    background: var(--primary-dark);
}

.map-controls {
    position: absolute;
    bottom: 20px;
    right: 15px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    z-index: 1000;
}

.map-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    color: var(--dark-light);
}

.map-btn:hover {
    background: var(--primary);
    color: white;
    transform: scale(1.1);
}

.coordinates-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.instructions {
    font-size: 0.9rem;
    color: var(--gray);
    margin-bottom: 15px;
    font-style: italic;
    padding: 10px 15px;
    background: rgba(6, 193, 103, 0.05);
    border-left: 3px solid var(--primary);
    border-radius: 0 var(--radius) var(--radius) 0;
}

/* Mumbai Landmarks */
.mumbai-landmarks {
    margin-bottom: 25px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.7);
    border-radius: var(--radius);
    border: 1px solid var(--light-gray);
}

.landmark-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.landmark-btn {
    padding: 10px 16px;
    background: white;
    border: 2px solid var(--light-gray);
    border-radius: 30px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    color: var(--dark-light);
    position: relative;
    overflow: hidden;
}

.landmark-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    opacity: 0;
    transition: var(--transition);
    z-index: -1;
}

.landmark-btn:hover {
    color: white;
    border-color: var(--primary);
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.landmark-btn:hover::before {
    opacity: 1;
}

.location-details {
    padding: 15px;
    background: rgba(255, 255, 255, 0.7);
    border-radius: var(--radius);
    font-size: 0.9rem;
    border: 1px solid var(--light-gray);
    display: flex;
    align-items: center;
    gap: 10px;
}

.location-details i {
    color: var(--primary);
    font-size: 1.1rem;
}

/* Submit Button */
.btn {
    text-align: center;
    margin-top: 30px;
    position: relative;
}

.btn button {
    padding: 16px 40px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    border: none;
    border-radius: 30px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-md);
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn button::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
    opacity: 0;
    transition: var(--transition);
    z-index: -1;
}

.btn button:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.btn button:hover::before {
    opacity: 1;
}

.btn button:active {
    transform: translateY(-1px);
    box-shadow: var(--shadow);
}

.btn button i {
    margin-right: 10px;
    font-size: 1.2rem;
}

/* Responsive Design */
@media (max-width: 992px) {
    .container {
        padding: 15px;
    }
    
    .form-container {
        padding: 30px;
    }
    
    .section-title, .contact-title {
        font-size: 1.6rem;
    }
    
    .map-container {
        height: 400px;
    }
    
    .search-box input {
        width: 200px;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
    
    .form-container {
        padding: 20px;
    }
    
    .logo {
        font-size: 2.4rem;
    }
    
    .tagline {
        font-size: 1rem;
    }
    
    .section-title, .contact-title {
        font-size: 1.4rem;
    }
    
    .image-radio-group {
        justify-content: center;
    }
    
    .coordinates-container {
        grid-template-columns: 1fr;
    }
    
    .search-box {
        right: 10px;
        top: 10px;
    }
    
    .search-box input {
        width: 150px;
    }
    
    .map-controls {
        bottom: 10px;
        right: 10px;
    }
    
    .landmark-buttons {
        justify-content: center;
    }
    
    .radio-group {
        flex-direction: column;
        gap: 15px;
    }
}

@media (max-width: 480px) {
    .logo {
        font-size: 2rem;
    }
    
    .tagline {
        font-size: 0.9rem;
    }
    
    header {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .form-container {
        padding: 15px;
    }
    
    .form-section {
        margin-bottom: 30px;
    }
    
    .section-title, .contact-title {
        font-size: 1.2rem;
        margin-bottom: 15px;
    }
    
    .map-container {
        height: 300px;
    }
    
    .search-box {
        flex-direction: column;
        width: calc(100% - 20px);
        right: 10px;
        left: 10px;
        top: 10px;
    }
    
    .search-box input {
        width: 100%;
        border-radius: var(--radius) var(--radius) 0 0;
    }
    
    .search-box button {
        border-radius: 0 0 var(--radius) var(--radius);
        padding: 10px;
    }
    
    .map-controls {
        flex-direction: row;
        bottom: 10px;
        left: 10px;
        right: auto;
    }
    
    .image-radio-group label {
        width: 100px;
        padding: 10px;
    }
    
    .image-radio-group label img {
        width: 50px;
        height: 50px;
    }
    
    .btn button {
        padding: 14px 30px;
        font-size: 1rem;
    }
}

/* Custom Leaflet Marker Styles */
.custom-marker {
    background: var(--primary);
    border: 3px solid white;
    border-radius: 50%;
    box-shadow: var(--shadow-md);
}    </style>
</head>
<body>
  <div class="container">
    <header>
        <div class="logo"> <b>FoodBridge</b></div>
        <div class="tagline">Connecting surplus food with those in need</div>
    </header>
    <div class="regformf" >
      <form action="" method="post" class="form-container">
            <!-- Food Details Section -->
            <div class="form-section">
                <div class="section-title">Food Details</div>
                
                <div class="input-group">
                    <label for="foodname" class="required">Food Name:</label>
                    <input type="text" id="foodname" name="foodname" required placeholder="e.g., Vegetable Biryani">
                </div>
                
                <div class="input-group">
                    <label class="required">Meal Type:</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" name="meal" id="veg" value="veg" required>
                            <label for="veg">Veg</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="meal" id="Non-veg" value="Non-veg">
                            <label for="Non-veg">Non-veg</label>
                        </div>
                    </div>
                </div>
                
                <div class="input-group">
                    <label for="category" class="required">Select the Category:</label>
                    <div class="image-radio-group">
                        <input type="radio" id="raw-food" name="image-choice" value="raw-food">
                        <label for="raw-food">
                            <img src="https://cdn-icons-png.flaticon.com/512/2832/2832495.png" alt="Raw Food">
                            <div>Raw Food</div>
                        </label>
                        
                        <input type="radio" id="cooked-food" name="image-choice" value="cooked-food" checked>
                        <label for="cooked-food">
                            <img src="https://cdn-icons-png.flaticon.com/512/2917/2917637.png" alt="Cooked Food">
                            <div>Cooked Food</div>
                        </label>
                        
                        <input type="radio" id="packed-food" name="image-choice" value="packed-food">
                        <label for="packed-food">
                            <img src="https://cdn-icons-png.flaticon.com/512/1175/1175015.png" alt="Packed Food">
                            <div>Packed Food</div>
                        </label>
                    </div>
                </div>
                
                <div class="input-group">
                    <label for="quantity" class="required">Quantity (number of persons / kg):</label>
                    <input type="text" id="quantity" name="quantity" required placeholder="e.g., 5 persons or 2 kg">
                </div>
            </div>
            
            <!-- Contact Details Section -->
            <div class="form-section">
                <div class="contact-details">
                    <div class="contact-title">Contact Details</div>
                    
                    <div class="input-group">
                        <label for="name" class="required">Name:</label>
                        <input type="text" id="name" name="name" value="isha" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="phoneno" class="required">Phone Number:</label>
                        <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required placeholder="10-digit mobile number">
                    </div>
                    
                    <div class="input-group">
                        <label for="district" class="required">District:</label>
                        <select id="district" name="district">
                            <option value="mumbai" selected>Mumbai</option>
                            <option value="thane">Thane</option>
                            <option value="navi_mumbai">Navi Mumbai</option>
                            <option value="palghar">Palghar</option>
                            <option value="raigad">Raigad</option>
                        </select>
                    </div>
                </div>
                
                <div class="input-group">
                    <label for="address" class="required">Address:</label>
                    <input type="text" id="address" name="address" required placeholder="Your full address per we can pickup ">
                    <!-- <div class="instructions">Click on the map to place a pin at your location</div> -->
</div>
                <!-- Map Section
                <div class="input-group">
                    <label for="address" class="required">Address:</label>
                    <input type="text" id="address" name="address" required placeholder="Your address will appear here when you place the pin on the map">
                    <div class="instructions">Click on the map to place a pin at your location</div>
</div>
                    
                    <div class="map-container">
                        <div class="map-marker-instruction">
                            <i class="fas fa-map-marker-alt"></i> Click to place location pin
                        </div>
                        
                        <div class="search-box">
                            <input type="text" id="search-input" placeholder="Search locations in Mumbai...">
                            <button type="button" id="search-btn"><i class="fas fa-search"></i></button>
                        </div>
                        
                        <div class="map-controls">
                            <button class="map-btn" id="locate-me" title="Locate Me">
                                <i class="fas fa-location-arrow"></i>
                            </button>
                            <button class="map-btn" id="zoom-in" title="Zoom In">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button class="map-btn" id="zoom-out" title="Zoom Out">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        
                        <div id="map"></div>
                    </div> -->
                    
                    <!-- <div class="coordinates-container">
                        <div class="input-group">
                            <label for="latitude">Latitude:</label>
                            <input type="text" id="latitude" name="latitude" readonly placeholder="Latitude will appear here">
                        </div>
                        
                        <div class="input-group">
                            <label for="longitude">Longitude:</label>
                            <input type="text" id="longitude" name="longitude" readonly placeholder="Longitude will appear here">
                        </div>
                    </div>
                     -->
                    <!-- <div class="mumbai-landmarks">
                        <div class="section-title">Mumbai Landmarks</div>
                        <div class="landmark-buttons">
                            <button type="button" class="landmark-btn" data-location="[19.0760, 72.8777]">South Mumbai</button>
                            <button type="button" class="landmark-btn" data-location="[19.2183, 72.9781]">Western Suburbs</button>
                            <button type="button" class="landmark-btn" data-location="[19.1520, 72.9300]">Bandra Kurla Complex</button>
                            <button type="button" class="landmark-btn" data-location="[19.0790, 72.9080]">Powai</button>
                            <button type="button" class="landmark-btn" data-location="[19.1860, 72.8630]">Borivali</button>
                        </div>
                    </div> -->
                    
                    <!-- <div class="location-details">
                        <div><i class="fas fa-info-circle"></i> <span id="location-info">Place a pin on the map to see address details</span></div>
                    </div> -->
                </div>
            </div>
            
            <div class="btn">
                <button type="submit" name="submit"><i class="fas fa-paper-plane"></i> Submit</button>
            </div>
        </form>
    </div>
  </div>
  
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        // Initialize map centered on Mumbai
        let map = L.map('map').setView([19.0760, 72.8777], 12);
        
        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Initialize variables
        let marker = null;
        
        // Add custom marker icon
        const customIcon = L.divIcon({
            className: 'custom-marker',
            html: '<i class="fas fa-map-pin" style="color: white; font-size: 11px; margin-top: 4px;"></i>',
            iconSize: [22, 22],
            iconAnchor: [11, 22]
        });
        
        // Add click event to map
        map.on('click', function(e) {
            placeMarker(e.latlng);
            updateAddress(e.latlng);
            updateCoordinates(e.latlng);
        });
        
        // Search functionality using Nominatim
        document.getElementById('search-btn').addEventListener('click', function() {
            const query = document.getElementById('search-input').value;
            if (query) {
                // Use Nominatim for geocoding with Mumbai focus
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query + ', Mumbai, India')}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            const result = data[0];
                            const latlng = L.latLng(parseFloat(result.lat), parseFloat(result.lon));
                            map.setView(latlng, 16);
                            placeMarker(latlng);
                            updateAddress(latlng);
                            updateCoordinates(latlng);
                            document.getElementById('address').value = result.display_name;
                        } else {
                            alert('Location not found in Mumbai. Please try a different search term.');
                        }
                    })
                    .catch(error => {
                        console.error('Error searching location:', error);
                        alert('Error searching for location. Please try again.');
                    });
            }
        });
        
        // Locate me functionality
        document.getElementById('locate-me').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latlng = L.latLng(position.coords.latitude, position.coords.longitude);
                    map.setView(latlng, 16);
                    placeMarker(latlng);
                    updateAddress(latlng);
                    updateCoordinates(latlng);
                }, function(error) {
                    alert('Unable to get your location. Please make sure location services are enabled.');
                });
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        });
        
        // Zoom controls
        document.getElementById('zoom-in').addEventListener('click', function() {
            map.zoomIn();
        });
        
        document.getElementById('zoom-out').addEventListener('click', function() {
            map.zoomOut();
        });
        
        // District change event - focusing on Mumbai areas
        document.getElementById('district').addEventListener('change', function() {
            const district = this.value;
            const districtCoordinates = {
                'mumbai': [19.0760, 72.8777],
                'thane': [19.2183, 72.9781],
                'navi_mumbai': [19.0330, 73.0297],
                'palghar': [19.6970, 72.7525],
                'raigad': [18.5153, 73.1822]
            };
            
            if (districtCoordinates[district]) {
                map.setView(districtCoordinates[district], 12);
                if (marker) {
                    marker.setLatLng(districtCoordinates[district]);
                    updateAddress(districtCoordinates[district]);
                    updateCoordinates(districtCoordinates[district]);
                }
            }
        });
        
        // Mumbai landmark buttons
        document.querySelectorAll('.landmark-btn').forEach(button => {
            button.addEventListener('click', function() {
                const coords = JSON.parse(this.getAttribute('data-location'));
                const latlng = L.latLng(coords[0], coords[1]);
                map.setView(latlng, 14);
                placeMarker(latlng);
                updateAddress(latlng);
                updateCoordinates(latlng);
            });
        });
        
        // Function to place marker
        function placeMarker(latlng) {
            if (marker) {
                marker.setLatLng(latlng);
            } else {
                marker = L.marker(latlng, {icon: customIcon, draggable: true}).addTo(map);
                marker.on('dragend', function() {
                    updateAddress(marker.getLatLng());
                    updateCoordinates(marker.getLatLng());
                });
            }
        }
        
        // Function to update address based on coordinates using Nominatim
        function updateAddress(latlng) {
            document.getElementById('location-info').textContent = 'Getting address details...';
            
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latlng.lat}&lon=${latlng.lng}&zoom=18&addressdetails=1`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        document.getElementById('address').value = data.display_name;
                        document.getElementById('location-info').textContent = data.display_name;
                    } else {
                        document.getElementById('location-info').textContent = 'Could not retrieve address details';
                    }
                })
                .catch(error => {
                    console.error('Error getting address:', error);
                    document.getElementById('location-info').textContent = 'Error retrieving address';
                });
        }
        
        // Function to update coordinate fields
        function updateCoordinates(latlng) {
            document.getElementById('latitude').value = latlng.lat.toFixed(6);
            document.getElementById('longitude').value = latlng.lng.toFixed(6);
        }
        
        // Initialize with Mumbai coordinates
        map.setView([19.0760, 72.8777], 12);
        
        // Handle window resize to adjust map
        window.addEventListener('resize', function() {
            setTimeout(function() {
                map.invalidateSize();
            }, 200);
        });
    </script>
</body>
</html>