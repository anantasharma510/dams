@echo off
mkdir DoctorAppointmentSystem
cd DoctorAppointmentSystem

# Admin Module
mkdir admin
cd admin
echo. > dashboard.php
echo. > manage_doctors.php
echo. > manage_users.php
echo. > manage_patients.php
echo. > appointment_history.php
echo. > contact_queries.php
echo. > doctor_logs.php
echo. > user_logs.php
echo. > reports.php
echo. > search_patient.php
echo. > change_password.php
echo. > index.php
echo. > manage_availability.php   # New file for managing doctor availability
mkdir css js
cd css
echo. > admin_styles.css
cd ..
cd js
echo. > admin_scripts.js
cd ../..

# Doctor Module
mkdir doctor
cd doctor
echo. > dashboard.php
echo. > appointment_history.php
echo. > manage_patients.php
echo. > search_patient.php
echo. > update_profile.php
echo. > change_password.php
echo. > index.php
echo. > view_availability.php   # New file for viewing their availability
mkdir css js
cd css
echo. > doctor_styles.css
cd ..
cd js
echo. > doctor_scripts.js
cd ../..

# User (Patient) Module
mkdir user
cd user
echo. > dashboard.php
echo. > book_appointment.php
echo. > appointment_history.php
echo. > medical_history.php
echo. > update_profile.php
echo. > change_password.php
echo. > index.php
mkdir css js
cd css
echo. > user_styles.css
cd ..
cd js
echo. > user_scripts.js
cd ../..

# Patient (Profile) Module
mkdir patient
cd patient
echo. > dashboard.php
echo. > book_appointment.php
echo. > appointment_history.php
echo. > medical_history.php
echo. > update_profile.php
echo. > change_password.php
echo. > index.php
mkdir css js
cd css
echo. > patient_styles.css
cd ..
cd js
echo. > patient_scripts.js
cd ../..

# Includes
cd ..
mkdir includes
cd includes
echo. > db.php
echo. > header.php
echo. > footer.php
echo. > functions.php
echo. > availability_functions.php   # New file for availability-related functions
cd ..

# Assets
mkdir assets
cd assets
mkdir images css js
cd css
echo. > main_styles.css
cd ..
cd js
echo. > main_scripts.js
cd ../..

# Config
cd ..
mkdir config
cd config
echo. > config.php
cd ..

# Authentication and General Files
echo. > login.php
echo. > register.php
echo. > logout.php
echo. > README.md
