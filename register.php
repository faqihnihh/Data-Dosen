<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        // Check if username already exists
        $check_stmt = $mysqli->prepare("SELECT * FROM login WHERE username = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error_message = "Username already exists!";
        } else {
            // Insert new user
            $insert_stmt = $mysqli->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
            $insert_stmt->bind_param("ss", $username, $password);
            
            if ($insert_stmt->execute()) {
                header("Location: login.php?registered=true");
                exit();
            } else {
                $error_message = "Registration failed!";
            }
            $insert_stmt->close();
        }
        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
    body {
        background-image: url('images/bg3.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    
    .login-container {
        background: rgba(255, 255, 255, 0.9);
        width: 90%;
        max-width: 400px;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        box-sizing: border-box;
    }
    
    .login-title {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }
    
    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    .login-button {
        width: 100%;
        padding: 12px;
        background: #292F33;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 20px;
    }

    .login-button:hover {
        background: #1d2327;
    }

    .error-message {
        color: red;
        text-align: center;
        margin-bottom: 15px;
    }

    .register-link {
        text-align: center;
        margin-top: 15px;
    }

    .register-link a {
        color: #292F33;
        text-decoration: none;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .login-container {
            padding: 20px;
        }

        .login-button {
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .login-container {
            padding: 15px;
        }

        .login-button {
            padding: 8px;
        }
    }
    </style>
</head>
<body>
    <div class="login-container">
        <?php if(isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <h2 class="login-title">Register</h2>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            
            <input type="submit" value="Register" class="login-button">
        </form>

        <div class="register-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>