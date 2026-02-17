<?php
ob_start(); 
// $connection = mysqli_connect("localhost:3307", "root", "");
// $db = mysqli_select_db($connection, 'demo');
include("connect.php"); 
include '../connection.php';
if($_SESSION['name']==''){
	header("location:deliverylogin.php");
}
$name=$_SESSION['name'];
$city=$_SESSION['city'];
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);
// $city= $result->city;
// echo $city;

$id=$_SESSION['Did'];



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <link rel="stylesheet" href="../home.css">

    <link rel="stylesheet" href="delivery.css">
    <style>
 /* ===== Enhanced Navigation Bar Styles ===== */
header {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

header.scrolled {
    padding: 12px 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

/* ===== Enhanced Logo Styles ===== */
header .logo {
    font-size: 28px;
    font-weight: 800;
    color: var(--dark);
    letter-spacing: -0.5px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
    transition: all 0.3s ease;
}

header .logo::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    border-radius: 3px;
    transition: width 0.3s ease;
}

header .logo:hover::after {
    width: 100%;
}

header .logo b {
    color: var(--primary);
    -webkit-text-fill-color: var(--primary);
}

/* ===== Enhanced Hamburger Menu ===== */
header .hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    gap: 5px;
    padding: 8px;
    border-radius: var(--radius-lg);
    transition: all 0.3s ease;
    position: relative;
    z-index: 101;
}

header .hamburger:hover {
    background: rgba(6, 193, 103, 0.1);
}

header .hamburger .line {
    width: 25px;
    height: 3px;
    background: var(--dark);
    border-radius: 3px;
    transition: all 0.3s ease;
    transform-origin: center;
}

header .hamburger.active .line:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
    background: var(--primary);
}

header .hamburger.active .line:nth-child(2) {
    opacity: 0;
    transform: scaleX(0);
}

header .hamburger.active .line:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
    background: var(--primary);
}

/* ===== Enhanced Navigation Bar ===== */
header .nav-bar {
    display: flex;
}

header .nav-bar ul {
    display: flex;
    list-style: none;
    gap: 35px;
}

header .nav-bar ul li {
    position: relative;
}

header .nav-bar ul li a {
    text-decoration: none;
    color: var(--dark-light);
    font-weight: 600;
    font-size: 16px;
    position: relative;
    transition: all 0.3s ease;
    padding: 10px 5px;
    display: flex;
    align-items: center;
    gap: 8px;
}

header .nav-bar ul li a::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    border-radius: 3px;
    transition: width 0.3s ease;
}

header .nav-bar ul li a::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, rgba(6, 193, 103, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
    border-radius: var(--radius-lg);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
}

header .nav-bar ul li a:hover {
    color: var(--primary);
    transform: translateY(-2px);
}

header .nav-bar ul li a:hover::before {
    width: 100%;
}

header .nav-bar ul li a:hover::after {
    opacity: 1;
}

header .nav-bar ul li a.active {
    color: var(--primary);
}

header .nav-bar ul li a.active::before {
    width: 100%;
}

header .nav-bar ul li a.active::after {
    opacity: 1;
}

/* ===== Enhanced Mobile Navigation ===== */
@media (max-width: 768px) {
    header {
        padding: 15px 20px;
    }
    
    header .hamburger {
        display: flex;
    }
    
    header .nav-bar {
        position: fixed;
        top: 0;
        right: -100%;
        width: 80%;
        max-width: 350px;
        height: 100vh;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        padding: 80px 30px 30px;
        transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15);
        z-index: 99;
        overflow-y: auto;
    }
    
    header .nav-bar.active {
        right: 0;
    }
    
    header .nav-bar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 70px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        z-index: -1;
    }
    
    header .nav-bar .nav-header {
        position: absolute;
        top: 20px;
        left: 30px;
        font-size: 24px;
        font-weight: 800;
        color: var(--white);
        letter-spacing: -0.5px;
    }
    
    header .nav-bar ul {
        flex-direction: column;
        width: 100%;
        gap: 5px;
        margin-top: 20px;
    }
    
    header .nav-bar ul li {
        width: 100%;
    }
    
    header .nav-bar ul li a {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        border-radius: var(--radius-lg);
        margin-bottom: 5px;
        position: relative;
        overflow: hidden;
    }
    
    header .nav-bar ul li a::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
        border-radius: var(--radius-lg) 0 0 var(--radius-lg);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }
    
    header .nav-bar ul li a::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(6, 193, 103, 0.1);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }
    
    header .nav-bar ul li a:hover {
        background: transparent;
        transform: translateX(5px);
    }
    
    header .nav-bar ul li a:hover::before {
        transform: scaleY(1);
    }
    
    header .nav-bar ul li a:hover::after {
        opacity: 1;
    }
    
    header .nav-bar ul li a.active {
        background: rgba(6, 193, 103, 0.1);
        color: var(--primary);
    }
    
    header .nav-bar ul li a.active::before {
        transform: scaleY(1);
    }
    
    header .nav-bar ul li a.active::after {
        opacity: 1;
    }
    
    /* Mobile Menu Overlay */
    .menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 98;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .menu-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    
    /* Mobile Menu Close Button */
    .menu-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .menu-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }
    
    .menu-close::before,
    .menu-close::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 2px;
        background: var(--white);
        border-radius: 2px;
    }
    
    .menu-close::before {
        transform: rotate(45deg);
    }
    
    .menu-close::after {
        transform: rotate(-45deg);
    }
}

/* ===== Navigation Item Icons ===== */
header .nav-bar ul li a i {
    font-size: 18px;
    margin-right: 8px;
    transition: all 0.3s ease;
}

header .nav-bar ul li a:hover i {
    transform: scale(1.1);
}

/* ===== Navigation Badge ===== */
.nav-badge {
    position: absolute;
    top: 5px;
    right: 5px;
    background: var(--accent);
    color: var(--white);
    font-size: 10px;
    font-weight: 600;
    padding: 2px 6px;
    border-radius: 10px;
    min-width: 18px;
    text-align: center;
}

/* ===== Enhanced Scroll Effect ===== */
@keyframes navFadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

header {
    animation: navFadeIn 0.6s ease forwards;
}

/* ===== Enhanced Logo Animation ===== */
@keyframes logoFloat {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-3px);
    }
}

header .logo {
    animation: logoFloat 3s ease-in-out infinite;
}

/* ===== Enhanced Mobile Menu Animation ===== */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(0);
    }
}

header .nav-bar.active {
    animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}
    </style>
</head>
<body>
<header>
        <div class="logo"> <b style="color: #06C167;">FoodBridge</b></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                 <li><a href="delivery.php" >Home</a></li>
               
                <!-- <li><a href="openmap.php" >map</a></li> -->
                <li><a href="deliverymyord.php" >myorders</a>
            </li>
            
                <li ><a href="../logout.php"  >Logout</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <script>
        hamburger=document.querySelector(".hamburger");
        hamburger.onclick =function(){
            navBar=document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
        }
    </script>
<?php

// echo var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=103.113.190.19')));
// echo "Your city: {$city}\n";

// $city = "<script language=javascript> document.write(geoplugin_city());</script>"; 
// $scity=$city;
?>
    <style>
        .itm{
            background-color: white;
            display: grid;
        }
        .itm img{
            width: 400px;
            height: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        p{
            text-align: center; font-size: 30PX;color: black; margin-top: 50px;
        }
        a{
            /* text-decoration: underline; */
        }
        @media (max-width: 767px) {
            .itm{
                /* float: left; */
                
            }
            .itm img{
                width: 350px;
                height: 350px;
            }
        }
    </style>
         <h2><center>Welcome <?php echo"$name";?></center></h2>

        <div class="itm" >

            <img src="../img/delivery.gif" alt="" width="400" height="400"> 
          
        </div>
        <!-- <h2><center>your Location : <?php echo"$city" ?></center></h2> -->
        <div class="get">
            <?php


// Define the SQL query to fetch unassigned orders
$sql = "SELECT fd.Fid AS Fid,fd.location as cure, fd.name,fd.phoneno,fd.date,fd.delivery_by, fd.address as From_address, 
ad.name AS delivery_person_name, ad.address AS To_address
FROM food_donations fd
LEFT JOIN admin ad ON fd.assigned_to = ad.Aid where assigned_to IS NOT NULL and   delivery_by IS NULL and fd.location='$city';
";

// Execute the query
$result=mysqli_query($connection, $sql);



// Check for errors
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

// Fetch the data as an associative array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// If the delivery person has taken an order, update the assigned_to field in the database
if (isset($_POST['food']) && isset($_POST['delivery_person_id'])) {
    $order_id = $_POST['order_id'];
    $delivery_person_id = $_POST['delivery_person_id'];
    $sql = "SELECT * FROM food_donations WHERE Fid = $order_id AND delivery_by IS NOT NULL";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Order has already been assigned to someone else
        die("Sorry, this order has already been assigned to someone else.");
    }


    $sql = "UPDATE food_donations SET delivery_by = $delivery_person_id WHERE Fid = $order_id";
    // $result = mysqli_query($conn, $sql);
    $result=mysqli_query($connection, $sql);


    if (!$result) {
        die("Error assigning order: " . mysqli_error($conn));
    }

    // Reload the page to prevent duplicate assignments
    header('Location: ' . $_SERVER['REQUEST_URI']);
    // exit;
    ob_end_flush();
}
// mysqli_close($conn);


?>
<div class="log">
<!-- <button type="submit" name="food" onclick="">My orders</button> -->
<a href="deliverymyord.php">My orders</a>

</div>
  

<!-- Display the orders in an HTML table -->
<div class="table-container">
         <!-- <p id="heading">donated</p> -->
         <div class="table-wrapper">
        <table class="table">
        <thead>
        <tr>
            <th >Name</th>
            <!-- <th>food</th> -->
            <!-- <th>Category</th> -->
            <th>phoneno</th>
            <th>date/time</th>
            <th>Pickup address</th>
            <th>Delivery Address</th>
            <th>Action</th>
         
          
           
        </tr>
        </thead>
       <tbody>

        <?php foreach ($data as $row) { ?>
        <?php    echo "<tr><td data-label=\"name\">".$row['name']."</td><td data-label=\"phoneno\">".$row['phoneno']."</td><td data-label=\"date\">".$row['date']."</td><td data-label=\"Pickup Address\">".$row['From_address']."</td><td data-label=\"Delivery Address\">".$row['To_address']."</td>";
?>
        
            <!-- <td><?= $row['Fid'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['address'] ?></td> -->
            <td data-label="Action" style="margin:auto">
                <?php if ($row['delivery_by'] == null) { ?>
                    <form method="post" action=" ">
                        <input type="hidden" name="order_id" value="<?= $row['Fid'] ?>">
                        <input type="hidden" name="delivery_person_id" value="<?= $id ?>">
                        <button type="submit" name="food">Take order</button>
                    </form>
                <?php } else if ($row['delivery_by'] == $id) { ?>
                    Order assigned to you
                <?php } else { ?>
                    Order assigned to another delivery person
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

            </div>

        
     
        

   <br>
   <br>
</body>
</html>