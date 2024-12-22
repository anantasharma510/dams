<?php
session_start();
include_once('../includes/db.php');
// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Admin is not logged in, redirect to login page
    header('Location: index.php');
    exit();
}

// If the admin is logged in, you can retrieve the admin ID if needed
// Initialize the variable
$total_users = 0;

// Query to count the number of users
// $sql = "SELECT COUNT(*) as total_users FROM patients";
// $result = $mysqli->query($sql);

// if ($result && $result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $total_users = $row['total_users'];
// }
// $sql = "SELECT COUNT(*) as total_doctors FROM doctors";
// $result = $mysqli->query($sql);

// if ($result && $result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $total_doctors = $row['total_doctors'];
// }
// $sql = "SELECT COUNT(*) as total_appointments FROM appointment";
// $result = $mysqli->query($sql);

// if ($result && $result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $total_appointments = $row['total_appointments'];
// }
// $sql = "SELECT COUNT(*) as total_patients FROM tblpatient";
// $result = $mysqli->query($sql);

// if ($result && $result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $total_patients = $row['total_patients'];
// }

// $sql = "SELECT COUNT(*) as total_contacts FROM tblcontact";
// $result = $mysqli->query($sql);

// if ($result && $result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $total_contacts = $row['total_contacts'];
// }
// // $sql = "SELECT COUNT(*) as total_reports FROM reports";
// // $result = $mysqli->query($sql);

// if ($result && $result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $total_reports = $row['total_reports'];
// }

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment Management Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
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
                        <i class="fa fa-user-md" aria-hidden="true"></i>
                        <span class="link-name">Doctors</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="specialisations.php"data-page=""> Doctor Specialisations</a></li>
                        <li><a href="add_doctors.php" data-page="">Add Doctors</a></li>
                        <li><a href="manage_doctors.php ">Manage Doctors</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenu-toggle">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Users</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="manage_users.php"data-page="">Manage Users</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenu-toggle">
                        <i class="uil uil-hospital"></i>
                        <span class="link-name">Patients</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                    <li><a href="add_patient.php"data-page="">Add Patients</a></li>
                        <li><a href="manage_patients.php"data-page="">Manage Patients</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenu-toggle">
                        <i class="fa-regular fa-address-book"></i>
                        <span class="link-name">Appointments</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="admin_view_appointments.php"data-page="" >Appointments</a></li>

                 
                       
                        
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenu-toggle">
                        <i class="fa-regular fa-address-book"></i>
                        <span class="link-name">Contact Queries</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="contact_queries.php"data-page="" >Contact Queries</a></li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenu-toggle">
                        <i class="fa-solid fa-file"></i>
                        <span class="link-name">Reports</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="reports.php" data-page="">Report </a></li>
                       
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenu-toggle">
                    <i class="fa-solid fa-gear"></i>
                        <span class="link-name">Setting</span>
                        <i class="fa fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="profile.php" data-page="">Porfile</a></li>
                      
                    </ul>
                </li>
                <li><a href="search_patient.php">
                    <i class="uil uil-search"></i>
                    <span class="link-name">Patient Search</span>
                </a></li>
               
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
            <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here..."> 
            </div> -->
            <!-- <img src="images/profile.jpg" alt=""> -->
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
                        <span class="text">Manage Users</span>
             

                    </div>
                    <div class="box box2">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span class="text">Manage Doctors</span>
                        <span class="number"><?php echo number_format($total_doctors); ?></span>
                    </div>
                    <div class="box box3">
                        <i class="fa-regular fa-calendar-check"></i>
                        <span class="text">Appointments</span>
                        <span class="number"><?php echo number_format($total_appointments); ?></span>
                    </div>
                    <div class="box box2">
                        <i class="fa-solid fa-hospital-user"></i>
                        <span class="text">Manage Patients</span>
                        <span class="number"><?php echo number_format($total_patients); ?><span>
                    </div>
                    <br>
                    <div class="box box3">
                    <i class="fa-solid fa-address-book"></i>
                        <span class="text">New Queries</span>
                        <span class="number"><?php echo number_format($total_contacts); ?></span>
                    </div>
                    <div class="box box4">
                    <i class="fa-solid fa-file"></i>
                        <span class="text">Reports</span>
                        <span class="number"><?php echo number_format($total_reports); ?></span>
                    </div>
                </div>
            </div>
            <div id="content-area"></div>
        </div>
    </section>
        <script> 
//   document.addEventListener('DOMContentLoaded', function() {
//     const submenuLinks = document.querySelectorAll('.submenu a');
//     const contentArea = document.getElementById('content-area');

//     submenuLinks.forEach(link => {
//         link.addEventListener('click', function(e) {
//             e.preventDefault(); // Prevent the default link behavior

//             const page = this.getAttribute('data-page'); // Get the page to load
//             const dashContent = document.querySelector('.dash-content .boxes');

//             // Hide the current content (boxes)
//             if (dashContent) {
//                 dashContent.style.display = 'none';
//             }

//             // Load the new content
//             fetch(page)
//                 .then(response => response.text())
//                 .then(data => {
//                     contentArea.innerHTML = data;
//                     contentArea.classList.add('loaded-content'); // Add custom class

//                     // Attach event listener for the form submission after content is loaded
//                     const form = contentArea.querySelector('form');
//                     if (form) {
//                         form.addEventListener('submit', function(e) {
//                             e.preventDefault(); // Prevent default form submission

//                             const formData = new FormData(form);
//                             const actionUrl = form.getAttribute('action');

//                             fetch(actionUrl, {
//                                 method: 'POST',
//                                 body: formData
//                             })
//                             .then(response => response.text())
//                             .then(result => {
//                                 // Optionally, show a success message or handle the result
//                                 // Reload the current page content
//                                 fetch(page)
//                                     .then(response => response.text())
//                                     .then(data => {
//                                         contentArea.innerHTML = data;
//                                         contentArea.classList.add('loaded-content');
//                                     });
//                             })
//                             .catch(error => {
//                                 console.error('Error submitting form:', error);
//                                 contentArea.innerHTML = '<p>Error submitting form. Please try again.</p>';
//                             });
//                         });
//                     }
//                 })
//                 .catch(error => {
//                     console.error('Error loading page:', error);
//                     contentArea.innerHTML = '<p>Error loading content. Please try again.</p>';
//                 });
//         });
//     });
// });


        </script>   
</body>
<script  src="js/adminscript.js">


 </script>
</html>
