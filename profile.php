<?php
include("login.php");

if($_SESSION['name'] == '') {
    header("location: signup.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Food Bridge</title>
    <link rel="stylesheet" href="home.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        
body{
    /* background-color: #20cd79; */
 
}


.cover{
 width: 100%;
    height: 500px;
    background:url('profilecover2.jpg')no-repeat;
    background-size: cover;
    display: grid;
    place-items:center;
    padding-top: 8rem; 
}
.profilebox{
    padding-top: 8rem;
   text-align: center;    
    width: 700px;
    height: 900px;
    margin: 20px auto ;
    
    /* background-color:rgba(90, 255, 208, 0.713); */
    /* box-shadow:0 .5rem 1rem rgba(0,0,0.1); */

    color:black;
    padding: 10px 20px 20px 20px;
    font-size: 20px;
    /* border-radius: 30px ; */
    

}
.info{
    /* font-family: 'Times New Roman', Times, serif; */
    
    text-align: left;
    padding: 10px;
}
.table-container{
    padding: 0 ;
    margin: 20px auto 10px;
    /* border: 1px solid ; */
  
}

.table{
    width: 100%;

    border-collapse:separate;
    border-spacing: 0px;
    


}
th{
    position:sticky;
    top:0px;
    background-color: #37db8c;
    /* background-color: rgb(240, 242, 246) */


    
}
th,td{
    /* border: 1px solid #12121385; */

}
.table-wrapper{
    max-height: 130px;
    overflow-y: scroll;

}
.table thead tr th{
    font-size: 14px;
    font-weight: medium;
    letter-spacing: 0.35px;
    opacity: 1;
    padding: 12px;
    vertical-align: top;

} 


/* for phone */
@media (max-width: 767px) {
    .cover{
        width: auto;
        height:auto;
        background:url('profilecover1.jpg')no-repeat;
        background-size: cover;
        display: grid;
        place-items:center;
        padding-top: 8rem;
      }
      .cover img{
        width: 100%;
        height: auto;
      }
    .profilebox{
        width: 350px;
        font-size: 14px;
        height: 600px;
        border-radius: 30px ;

        
    }
    .table thead tr th{
        font-size: 14px;
        font-weight: medium;
        letter-spacing: 0.35px;
        opacity: 1;
        padding: 5px;
    }
}


.headingline{
    font-size: 28px;
    text-align: center;
    align-items: center; 
    text-decoration: underline 5px;
    text-decoration-color: #06C167;
   }


   .profile-container {
            min-height: 100vh;
            background: #f8f9fa;
            padding: 2rem;
        }
        
        .profile-header {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            flex-shrink: 0;
        }
        
        .profile-info h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .profile-info p {
            color: var(--gray);
            margin-bottom: 0.3rem;
        }
        
        .profile-stats {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .profile-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }
        
        .profile-sidebar {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            height: fit-content;
        }
        
        .sidebar-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .info-item {
            display: flex;
            margin-bottom: 1.2rem;
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f0f9f4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .info-details h4 {
            font-size: 1rem;
            margin-bottom: 0.2rem;
        }
        
        .info-details p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .profile-main {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
        }
        
        .donations-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .donations-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .donations-table th,
        .donations-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .donations-table th {
            font-weight: 600;
            color: var(--dark);
            background: #f8f9fa;
        }
        
        .donations-table tr:hover {
            background: #f8f9fa;
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .no-donations {
            text-align: center;
            padding: 3rem;
            color: var(--gray);
        }
        
        .no-donations i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 992px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-stats {
                justify-content: center;
            }
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
            
        </nav>
    </header>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-info">
                <h1><?php echo $_SESSION['name']; ?></h1>
                <p><i class="fas fa-envelope"></i> <?php echo $_SESSION['email']; ?></p>
                <p><i class="fas fa-venus-mars"></i> <?php echo ucfirst($_SESSION['gender']); ?></p>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">
                            <?php
                                $email = $_SESSION['email'];
                                $query = "SELECT COUNT(*) as total FROM food_donations WHERE email='$email'";
                                $result = mysqli_query($connection, $query);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['total'];
                            ?>
                        </div>
                        <div class="stat-label">Donations</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">
                            <?php
                                $query = "SELECT SUM(quantity) as total FROM food_donations WHERE email='$email'";
                                $result = mysqli_query($connection, $query);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['total'] ?: 0;
                            ?>
                        </div>
                        <div class="stat-label">Meals Provided</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">
                            <?php
                                $query = "SELECT COUNT(DISTINCT date) as days FROM food_donations WHERE email='$email'";
                                $result = mysqli_query($connection, $query);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['days'];
                            ?>
                        </div>
                        <div class="stat-label">Active Days</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="profile-content">
            <div class="profile-sidebar">
                <h3 class="sidebar-title">Account Information</h3>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="info-details">
                        <h4>Full Name</h4>
                        <p><?php echo $_SESSION['name']; ?></p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-details">
                        <h4>Email Address</h4>
                        <p><?php echo $_SESSION['email']; ?></p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-venus-mars"></i>
                    </div>
                    <div class="info-details">
                        <h4>Gender</h4>
                        <p><?php echo ucfirst($_SESSION['gender']); ?></p>
                    </div>
                </div>
                
                <!-- <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="info-details">
                        <h4>Member Since</h4>
                        <p>January 2023</p>
                    </div>
                </div> -->
                
                <a href="logout.php" class="btn" style="width: 100%; margin-top: 1rem;">
                    <i class="fas fa-sign-out-alt" style="margin-right: 0.5rem;"></i> Logout
                </a>
            </div>
            
            <div class="profile-main">
                <div class="donations-header">
                    <h2 class="sidebar-title">My Donations</h2>
                    <a href="fooddonateform.php" class="btn">
                        <i class="fas fa-plus" style="margin-right: 0.5rem;"></i> New Donation
                    </a>
                </div>
                
                <?php
                    $email = $_SESSION['email'];
                    $query = "SELECT * FROM food_donations WHERE email='$email' ORDER BY date DESC";
                    $result = mysqli_query($connection, $query);
                    
                    if(mysqli_num_rows($result) > 0) {
                        echo '<table class="donations-table">
                            <thead>
                                <tr>
                                    <th>Food Item</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>';
                            //<th>Status</th>
                        
                        while($row = mysqli_fetch_assoc($result)) {
                           // $statusClass = $row['status'] == 'completed' ? 'status-completed' : 'status-pending';
                            //$statusText = $row['status'] == 'completed' ? 'Completed' : 'Pending';
                            
                            echo "<tr>
                                <td>{$row['food']}</td>
                                <td>{$row['type']}</td>
                                <td>{$row['category']}</td>
                                <td>{$row['quantity']} servings</td>
                                <td>" . date('M d, Y', strtotime($row['date'])) . "</td>
                                
                            </tr>";
                            //<td><span class='status-badge $statusClass'>$statusText</span></td>
                        }
                        
                        
                        echo '</tbody></table>';
                    } else {
                        echo '<div class="no-donations">
                            <i class="fas fa-utensils"></i>
                            <h3>No donations yet</h3>
                            <p>You haven\'t made any food donations yet. Start making a difference today!</p>
                            <a href="fooddonateform.php" class="btn" style="margin-top: 1rem;">
                                <i class="fas fa-plus" style="margin-right: 0.5rem;"></i> Donate Food Now
                            </a>
                        </div>';
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        hamburger = document.querySelector(".hamburger");
        navBar = document.querySelector(".nav-bar");
        
        hamburger.onclick = function() {
            navBar.classList.toggle("active");
        }



        
    </script>
</body>
</html>