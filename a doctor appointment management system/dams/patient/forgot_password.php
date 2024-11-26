<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Correctly include Composer's autoload.php
require __DIR__ . '/../../../../../vendor/autoload.php'; 



// Include database connection
include(__DIR__ . '/../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    if (!empty($email)) {
        $query = "SELECT id FROM patients WHERE email = ?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Generate reset token and expiry time
                $token = bin2hex(random_bytes(50));
                $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

                // Insert reset request into the database
                $insertQuery = "INSERT INTO password_resets (email, token, expiry) VALUES (?, ?, ?)";
                if ($insertStmt = $mysqli->prepare($insertQuery)) {
                    $insertStmt->bind_param("sss", $email, $token, $expiry);
                    $insertStmt->execute();

                    // Generate reset link
                    $resetLink = "http://localhost/damss/doctor_appointment_management_system/dams/patient/reset_password.php?token=" . $token;

                    // Send email using PHPMailer
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'your_email@gmail.com';
                        $mail->Password = 'your_password'; // Use app-specific password if necessary
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        // Email details
                        $mail->setFrom('your_email@gmail.com', 'Doctor Appointment System');
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = 'Password Reset Request';
                        $mail->Body = "Click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";

                        $mail->send();
                        echo "Password reset link has been sent to your email.";
                    } catch (Exception $e) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    }
                }
            } else {
                echo "No account found with that email.";
            }
        }
    } else {
        echo "Email is required.";
    }
}
?>
