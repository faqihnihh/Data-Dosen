<?php
// Include database connection file
include_once("config.php");

// Handle form submission
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $npp_dosen = $_POST['npp_dosen'];
    $nama_dosen = $_POST['nama_dosen'];
    $matkul_dosen = $_POST['matkul_dosen'];

    // Update user data in the database
    $result = mysqli_query($mysqli, "UPDATE users SET npp_dosen='$npp_dosen', nama_dosen='$nama_dosen', matkul_dosen='$matkul_dosen' WHERE id=$id");

    // Redirect to index page after successful update
    if ($result) {
        echo "<script>alert('Data successfully updated!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error updating data: " . mysqli_error($mysqli) . "');</script>";
    }
}

// Fetch data for the given ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

    if ($result) {
        $user_data = mysqli_fetch_array($result);
        $npp_dosen = $user_data['npp_dosen'];
        $nama_dosen = $user_data['nama_dosen'];
        $matkul_dosen = $user_data['matkul_dosen'];
    } else {
        echo "<script>alert('Data not found!'); window.location.href = 'index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lecturer Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url("images/bg1.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .header {
            padding: 15px;
            text-align: center;
            background: #292F33;
            color: white;
        }

        .content-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 30px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 50%;
        }

        .content-container h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }

        .btn-success, .btn-danger {
            width: 48%;
        }
    </style>
</head>
<body>
    <div class="header">
        <table align="center">
            <tr>
                <td><img src="images/hamzanwadi_logo.png" width="100px"></td>
                <td>
                    <h1 style="color: white;">Lecturer List</h1>
                    <p style="color: white;">HAMZANWADI UNIVERSITY</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="content-container">
        <h2>Edit Lecturer Data</h2>
        <form method="post" action="edit.php">
            <div class="form-group">
                <label for="npp"><strong>NPP:</strong></label>
                <input type="text" class="form-control" id="npp" name="npp_dosen" value="<?php echo $npp_dosen; ?>" required>
            </div>
            <div class="form-group">
                <label for="nama"><strong>NAME:</strong></label>
                <input type="text" class="form-control" id="nama" name="nama_dosen" value="<?php echo $nama_dosen; ?>" required>
            </div>
            <div class="form-group">
                <label for="matkul"><strong>SUBJECT:</strong></label>
                <input type="text" class="form-control" id="matkul" name="matkul_dosen" value="<?php echo $matkul_dosen; ?>" required>
            </div>
            <div class="form-group text-center">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <button type="submit" name="update" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                <a href="index.php" class="btn btn-danger"><i class="fa fa-ban"></i> Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
