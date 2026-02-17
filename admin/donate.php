<?php
include "../connection.php";
include("connect.php"); 
if($_SESSION['name']==''){
    header("location:signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Donations by Location</title>

<?php
    $connection=mysqli_connect("localhost:3306","root","152005");
    $db=mysqli_select_db($connection,'foodbridge');
?>

<style>
    /* CSS Variables for consistent theming */
    :root {
        --primary: rgba(255, 107, 107, 0.9);
        --primary-dark: rgba(235, 87, 87, 0.9);
        --secondary: #f8f9fa;
        --text: #333;
        --light-text: #777;
        --border: #e1e1e1;
        --shadow: 0 0 10px rgba(0,0,0,0.1);
        --radius: 8px;
        --white: #ffffff;
        --sidebar-width: 250px;
        --sidebar-collapsed-width: 70px;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text);
        background-color: var(--secondary);
        margin: 0;
        padding: 0;
    }
    
    /* Navigation Styles */
    nav {
        background: var(--white);
        box-shadow: var(--shadow);
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: var(--sidebar-width);
        padding: 20px 0;
        transition: all 0.3s ease;
        z-index: 100;
        border-right: 4px solid var(--primary);
        overflow-x: hidden;
    }
    
    nav.collapsed {
        width: var(--sidebar-collapsed-width);
    }
    
    nav .logo-name {
        display: flex;
        align-items: center;
        margin-left: 20px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    
    nav.collapsed .logo-name {
        margin-left: 12px;
    }
    
    nav .logo-image {
        display: flex;
        justify-content: center;
        min-width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        font-size: 20px;
        flex-shrink: 0;
    }
    
    nav .logo-name .logo_name {
        font-size: 22px;
        font-weight: 600;
        color: var(--primary);
        margin-left: 14px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    nav.collapsed .logo_name {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }
    
    nav .menu-items {
        height: calc(100% - 90px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .menu-items li {
        list-style: none;
    }
    
    .menu-items li a {
        display: flex;
        align-items: center;
        height: 50px;
        text-decoration: none;
        position: relative;
        padding: 0 20px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    nav.collapsed .menu-items li a {
        padding: 0;
        justify-content: center;
    }
    
    .nav-links li a:hover {
        background-color: rgba(255, 107, 107, 0.1);
    }
    
    .nav-links li a.active {
        background-color: rgba(255, 107, 107, 0.15);
        border-left: 4px solid var(--primary);
    }
    
    nav.collapsed .nav-links li a.active {
        border-left: none;
        border-top: 4px solid var(--primary);
    }
    
    .menu-items li a i {
        font-size: 24px;
        min-width: 45px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--light-text);
        transition: all 0.3s ease;
    }
    
    nav.collapsed .menu-items li a i {
        min-width: auto;
    }
    
    .menu-items li a .link-name {
        font-size: 18px;
        font-weight: 500;
        color: var(--text);
        transition: all 0.3s ease;
    }
    
    nav.collapsed .menu-items li a .link-name {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }
    
    .nav-links li a.active i,
    .nav-links li a.active .link-name {
        color: var(--primary);
    }
    
    .nav-links li a:hover i {
        color: var(--primary);
    }
    
    .logout-mode {
        padding-top: 10px;
        border-top: 1px solid var(--border);
        margin-top: auto;
    }
    
    .logout-mode li a {
        display: flex;
        align-items: center;
        height: 50px;
        text-decoration: none;
        padding: 0 20px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    nav.collapsed .logout-mode li a {
        padding: 0;
        justify-content: center;
    }
    
    .logout-mode li a:hover {
        background-color: rgba(255, 107, 107, 0.1);
    }
    
    .logout-mode li a i {
        font-size: 24px;
        min-width: 45px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--light-text);
        transition: all 0.3s ease;
    }
    
    nav.collapsed .logout-mode li a i {
        min-width: auto;
    }
    
    .logout-mode li a .link-name {
        font-size: 18px;
        font-weight: 500;
        color: var(--text);
    }
    
    nav.collapsed .logout-mode li a .link-name {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }
    
    .logout-mode li a:hover i {
        color: var(--primary);
    }
    
    /* Dashboard Content */
    .dashboard {
        position: relative;
        left: var(--sidebar-width);
        background-color: var(--secondary);
        min-height: 100vh;
        width: calc(100% - var(--sidebar-width));
        padding: 20px;
        transition: all 0.3s ease;
    }
    
    .dashboard.expanded {
        left: var(--sidebar-collapsed-width);
        width: calc(100% - var(--sidebar-collapsed-width));
    }
    
    .dashboard .top {
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 20px;
        background-color: var(--white);
        box-shadow: var(--shadow);
        width: 100%;
        height: 60px;
        z-index: 10;
        transition: all 0.3s ease;
    }
    
    .dashboard .top .left-section {
        display: flex;
        align-items: center;
        margin-left: var(--sidebar-width);
        transition: margin-left 0.3s ease;
    }
    
    .dashboard.expanded .top .left-section {
        margin-left: var(--sidebar-collapsed-width);
    }
    
    .dashboard .top .sidebar-toggle {
        font-size: 24px;
        color: var(--text);
        cursor: pointer;
        padding: 8px;
        border-radius: 4px;
        transition: all 0.3s ease;
        margin-right: 15px;
    }
    
    .dashboard .top .sidebar-toggle:hover {
        background-color: rgba(255, 107, 107, 0.1);
        color: var(--primary);
    }
    
    .dashboard .top .logo {
        font-size: 22px;
        font-weight: 600;
        color: var(--primary);
    }
    
    .dashboard .top .user {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }
    
    .dashboard .top .user .user-name {
        font-size: 16px;
        font-weight: 500;
        color: var(--text);
        margin-right: 10px;
    }
    
    .dashboard .top .user .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    
    .dash-content {
        padding-top: 80px;
    }
    
    .activity {
        background-color: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 20px;
    }
    
    /* Location Filter Section */
    .location {
        margin-bottom: 25px;
        padding: 20px;
        background-color: rgba(255, 107, 107, 0.05);
        border-radius: var(--radius);
        border: 1px solid var(--border);
    }
    
    .location .logo {
        font-size: 18px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 15px;
        display: block;
    }
    
    .location form {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .location label {
        font-weight: 500;
        color: var(--text);
    }
    
    .location select {
        padding: 10px 15px;
        border: 2px solid var(--border);
        border-radius: var(--radius);
        background: var(--white);
        color: var(--text);
        font-weight: 500;
        min-width: 200px;
        transition: all 0.3s ease;
    }
    
    .location select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
    }
    
    .location input[type="submit"] {
        padding: 10px 20px;
        background-color: var(--primary);
        color: var(--white);
        border: none;
        border-radius: var(--radius);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .location input[type="submit"]:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table th, .table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }
    
    .table th {
        background-color: var(--secondary);
        font-weight: 600;
        color: var(--text);
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }
    
    .table tr:hover {
        background-color: var(--secondary);
    }
    
    .empty-state {
        text-align: center;
        padding: 30px;
        color: var(--light-text);
    }
    
    .empty-state i {
        font-size: 40px;
        margin-bottom: 10px;
        color: #ddd;
    }
    
    /* Tooltip for collapsed sidebar */
    .menu-items li a {
        position: relative;
    }
    
    .menu-items li a .tooltip {
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        margin-left: 10px;
        background-color: var(--white);
        color: var(--text);
        padding: 6px 12px;
        border-radius: 4px;
        box-shadow: var(--shadow);
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        z-index: 1000;
    }
    
    nav.collapsed .menu-items li a:hover .tooltip {
        opacity: 1;
    }
    
    /* Responsive Styles */
    @media (max-width: 1100px) {
        nav {
            left: calc(-1 * var(--sidebar-width));
        }
        
        nav.collapsed {
            left: 0;
            width: var(--sidebar-width);
        }
        
        .dashboard {
            left: 0;
            width: 100%;
        }
        
        .dashboard.expanded {
            left: 0;
            width: 100%;
        }
        
        .dashboard .top .left-section {
            margin-left: 20px;
        }
        
        .dashboard.expanded .top .left-section {
            margin-left: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .location form {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .location select {
            width: 100%;
        }
        
        .location input[type="submit"] {
            width: 100%;
        }
        
        .table th, .table td {
            padding: 8px 10px;
            font-size: 14px;
        }
    }
</style>

</head>
<body>
    <nav id="sidebar">
        <div class="logo-name">
            <div class="logo-image">
                <i class="fas fa-utensils"></i>
            </div>
            <span class="logo_name">ADMIN</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                    <span class="tooltip">Dashboard</span>
                </a></li>
                <li><a href="analytics.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                    <span class="tooltip">Analytics</span>
                </a></li>
                <li><a href="#" class="active">
                    <i class="uil uil-heart"></i>
                    <span class="link-name">Donations</span>
                    <span class="tooltip">Donations</span>
                </a></li>
                <!-- <li><a href="feedback.php">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Feedbacks</span>
                    <span class="tooltip">Feedbacks</span>
                </a></li> -->
                <li><a href="adminprofile.php">
                    <i class="uil uil-user"></i>
                    <span class="link-name">Profile</span>
                    <span class="tooltip">Profile</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="../logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                    <span class="tooltip">Logout</span>
                </a></li>
            </ul>
        </div>
    </nav>

    <section class="dashboard" id="dashboard">
        <div class="top">
            <div class="left-section">
                <i class="uil uil-bars sidebar-toggle" id="sidebar-toggle"></i>
                <p class="logo">FoodBridge</p>
            </div>
            <div class="user">
                <span class="user-name">Welcome, Admin</span>
                <div class="user-avatar">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>

        <div class="dash-content">
            <div class="activity">
                <div class="location">
                    <form method="post">
                        <label for="location" class="logo">Select Location:</label>
                        <select id="location" name="location">
                            <option value="chennai">Chennai</option>
                            <option value="madurai">Madurai</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="coimbatore">Coimbatore</option>
                        </select>
                        <input type="submit" value="Get Details">
                    </form>

                    <?php
                        if(isset($_POST['location'])) {
                            $location = mysqli_real_escape_string($connection, $_POST['location']);
                            
                            $sql = "SELECT * FROM food_donations WHERE location='$location' ORDER BY date DESC";
                            $result = mysqli_query($connection, $sql);
                            
                            if ($result && mysqli_num_rows($result) > 0) {
                                echo '<div class="table-container">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Name</th>';
                                echo '<th>Food</th>';
                                echo '<th>Category</th>';
                                echo '<th>Phone No</th>';
                                echo '<th>Date/Time</th>';
                                echo '<th>Address</th>';
                                echo '<th>Quantity</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td data-label="Name">' . htmlspecialchars($row['name']) . '</td>';
                                    echo '<td data-label="Food">' . htmlspecialchars($row['food']) . '</td>';
                                    echo '<td data-label="Category">' . htmlspecialchars($row['category']) . '</td>';
                                    echo '<td data-label="Phone No">' . htmlspecialchars($row['phoneno']) . '</td>';
                                    echo '<td data-label="Date/Time">' . htmlspecialchars($row['date']) . '</td>';
                                    echo '<td data-label="Address">' . htmlspecialchars($row['address']) . '</td>';
                                    echo '<td data-label="Quantity">' . htmlspecialchars($row['quantity']) . '</td>';
                                    echo '</tr>';
                                }
                                
                                echo '</tbody>';
                                echo '</table>';
                                echo '</div>';
                            } else {
                                echo '<div class="empty-state">';
                                echo '<i class="fas fa-inbox"></i>';
                                echo '<p>No results found for ' . htmlspecialchars($location) . '</p>';
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebar-toggle");
            const dashboard = document.getElementById("dashboard");
            
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add("collapsed");
                dashboard.classList.add("expanded");
            }
            
            sidebarToggle.addEventListener("click", () => {
                sidebar.classList.toggle("collapsed");
                dashboard.classList.toggle("expanded");
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains("collapsed"));
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth <= 1100 && !sidebar.classList.contains("collapsed")) {
                    sidebar.classList.add("collapsed");
                    dashboard.classList.add("expanded");
                    localStorage.setItem('sidebarCollapsed', 'true');
                }
            });
        });
    </script>
</body>
</html>