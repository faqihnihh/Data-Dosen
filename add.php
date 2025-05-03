<!DOCTYPE html>
<html>
<head>
    <title>Add Lecturer - HAMZANWADI UNIVERSITY</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        /* Header Styles */
        .header {
            background-color: #ffcb05;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .university-logo {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .header h1 {
            margin: 0;
            color: #1a1a1a;
            font-size: 24px;
        }

        /* Back Link */
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #006838;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Form Container */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Form Styles */
        .input-table {
            width: 100%;
        }

        .input-table td {
            padding: 10px;
            vertical-align: middle;
        }

        .input-table td:first-child {
            width: 120px;
            font-weight: 500;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: #006838;
        }

        .submit-button {
            background-color: #006838;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }

        .submit-button:hover {
            background-color: #005830;
        }

        /* Success Message */
        .success-message {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f5e9;
            border: 1px solid #c8e6c9;
            border-radius: 4px;
            color: #2e7d32;
        }

        .success-message a {
            color: #006838;
            text-decoration: none;
            font-weight: 500;
        }

        .success-message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="header">
	<img src="images/hamzanwadi_logo.png" width="60px" class="mr-3" alt="HAMZANWADI UNIVERSITY">
        <h1>Add Lecturer</h1>
    </div>

    <a href="index.php" class="btn btn-danger">
        <i class="fas fa-sign-out-alt"></i> back</a>

    <div class="form-container">
        <form action="add.php" method="post" name="form1">
            <table class="input-table">
                <tr> 
                    <td>NPP</td>
                    <td><input type="text" name="npp_dosen" class="form-input" required></td>
                </tr>
                <tr> 
                    <td>Nama</td>
                    <td><input type="text" name="nama_dosen" class="form-input" required></td>
                </tr>
                <tr> 
                    <td>Mata Kuliah</td>
                    <td><input type="text" name="matkul_dosen" class="form-input" required></td>
                </tr>
                <tr> 
                    <td></td>
                    <td><input type="submit" name="Submit" value="Add Lecturer" class="submit-button"></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    if(isset($_POST['Submit'])) {
        $npp_dosen = $_POST['npp_dosen'];
        $nama_dosen = $_POST['nama_dosen'];
        $matkul_dosen = $_POST['matkul_dosen'];
        
        include_once("config.php");
        
        $result = mysqli_query($mysqli, "INSERT INTO users(npp_dosen,nama_dosen,matkul_dosen) VALUES('$npp_dosen','$nama_dosen','$matkul_dosen')");
        
        if($result) {
            echo '<div class="success-message">
                    Lecturer added successfully. <a href="index.php">View Lecturers</a>
                  </div>';
        }
    }
    ?>
</body>
</html>