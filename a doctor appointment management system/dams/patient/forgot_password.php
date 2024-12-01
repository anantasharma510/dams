<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    <link href="../patient/css/patient_styles.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <div class="left">
                <img src="../patient/img/sam.png" alt="Forgot Password Image">
            </div>
            <div class="right">
                <h2>Forgot Password</h2>
                <form action="forgot_password_process.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn-login">Submit</button>
                </form>
                <p>Remembered your password? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
</body>

</html>
