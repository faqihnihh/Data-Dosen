<?php
session_start();
include 'config.php'; // Pastikan file config.php berisi koneksi database

/* Check Login form submitted */
if(isset($_POST['Submit'])){
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $mysqli->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil
        $user_data = $result->fetch_assoc();
        $_SESSION['UserData']['Username'] = $username;
        header("location:index.php");
        exit;
    } else {
        // Login gagal
        $msg = "<span style='color:red'>Username atau password salah</span>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Hamzanwadi University</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        background: #004723; /* Menggunakan warna dari index.php */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 20px;
    }

    .login-button:hover {
        background: #003319;
    }

    .error-message {
        color: red;
        text-align: center;
        margin-bottom: 15px;
    }

    .register-link {
        margin-top: 15px;
        text-align: center;
    }

    .register-link a {
        color: #004723;
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
        <?php if(isset($msg)){?>
            <div class="error-message"><?php echo $msg;?></div>
        <?php } ?>
        
        <h2 class="login-title">Login</h2>
        
        <form action="" method="post" name="Login_Form">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="Username" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="Password" required>
            </div>
            
            <input type="submit" name="Submit" value="Login" class="login-button">
        </form>

        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>