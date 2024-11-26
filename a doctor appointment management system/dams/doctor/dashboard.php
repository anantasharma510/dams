 
<?php
session_start(); // Start the session

// Include database connection
include('../includes/db.php'); // Adjust the path as needed

// Check if the user is logged in
if (!isset($_SESSION['doctor_logged_in']) || $_SESSION['doctor_logged_in'] !== true) {
    // User is not logged in, redirect to login page
    header('Location: index.php'); // Adjust the path as needed
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment Management Dashboard</title>
    <link rel="stylesheet" href="css/dstyle.css">
    <link rel="stylesheet" href="css/.css">
  

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>


</style>
    <style>

.submenu {
    display: none;
    padding-left: 20px;
    font-size: 13px; /* Adjust font size as needed */
    transition: all 0.3s ease;
    background-color: #f9f9f9;
    color: #2c3e50;
    border-left: 3px solid #3498db;
    /* Smooth transition for all properties */
}

.submenu.active {
    transition: all 0.3s ease-in-out; 
    display: block;
    opacity: 1; /* Ensure opacity transition */
    margin-top: 5px; /* Add some space above the submenu when active */
    color: #2980b9; /* Smooth transition for all properties */
}

.dropdown-icon.rotate {
    transform: rotate(180deg); /* Rotate the icon when submenu is active */
    color: #27ae60;/* Smooth transition for rotation */
}

 /* Overlay */
 
</style>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../../sam.png" alt="">
            </div>
            <span class="logo_name">DAMS</span>
        </div>

        <div class="menu-items">
            
        <ul class="nav-links">
    <li><a href="#" onclick="reloadPage(); return false;">
        <i class="uil uil-estate"></i>
        <span class="link-name">Dashboard</span>
    </a></li>
</ul>

   
<script>
function reloadPage() {
    if (confirm("Reload the page?")) {
        location.reload();
    }
}
</script>
<li>
                    <a href="#" class="submenu-toggle">
                        <i class="uil uil-hospital"></i>
                        <span class="link-name">Appointments</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="appointment_history.php"data-page="">Appointment History</a></li>
                        <li><a href="view_availabilty.php ">view availabilty</a></li>
                      
                    </ul>
                </li>
               
                <li>
                    <a href="#" class="submenu-toggle">
                        <i class="uil uil-hospital"></i>
                        <span class="link-name">Appointed patients </span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                       
                        <li><a href="view_patient.php">view patient</a></li>
                        <li><a href="confirm_visit.php">confirm visit</a></li>
                    </ul>
                </li>
               
              
               
                
             

                <li>
                <li><a href="view_reports.php">
                    <i class="uil uil-search"></i>
                    <span class="link-name">Patientreports</span>
                </a></li>
                <li>
                    <a href="#" class="submenu-toggle">
                        <i class="uil uil-hospital"></i>
                        <span class="link-name">Patients</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="manage_patient.php"data-page="">Manage Patient</a></li>
                        <li><a href="add_patient.php ">Add Patients</a></li>
                    </ul>
                </li>
              
                
            
                    
               
                <li><a href="#">
                    <i class="uil uil-search"></i>
                    <span class="link-name">Patient Search</span>
                </a></li>
               
                <li>
                    <a href="#" class="submenu-toggle">
                    <i class="fa-solid fa-gear"></i>
                        <span class="link-name">Setting</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="change_profile.php" data-page="">Profile</a></li>
                        <li><a href="change_password.php" data-page="">change password</a></li>
                    </ul>
                    
                </li>
               
               
            </ul>
            
            <ul class="logout-mode">
               
                    <span class="link-name"></span>
                </a></li>
                <li><a href="logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="link-name">logout</span>
                </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
           
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                   
                </div>
                
                <div class="boxes">
                    <div class="box box1">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <span class="text"><a href="profile.php">profile</a></span>
                        <span class="number">Update Profile</a></span>
                    </div>
                    <div class="box box2">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span class="text"><a href="profile.php">
                        My Appointments</a></span>
                        <span class="number">  History </span>
                    </div>
                    <br>
                    <div class="box box3">
                        <i class="fa-regular fa-calendar-check"></i>
                        <span class="text"><a href="profile.php">Book My Appointment</a></span>
                        <span class="number">  Appointments</span>
                    </div>
                  
                    
                </div>
            </div>
            <div id="content-area"></div>
        </div>
    </section>
        <script> 

        </script>   
</body>
<script  src="js/doctor_scripts.js">


 </script>
</html>
