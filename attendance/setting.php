<?php
session_start();
include('config.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

$sql = "SELECT * FROM tableform WHERE id = $id";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['done'])) {
    $name = $_POST['name'];
    $father = $_POST['fatherName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $newPass = md5($_POST['newPass']);
    $confirmPass = md5($_POST['confirmPass']);

    $update_sql = "";

    if (!empty($newPass) && !empty($confirmPass)) {
        if ($newPass !== $confirmPass) {
            echo "<script>alert('Passwords do not match!');</script>";
        } else {
            $update_sql = "UPDATE tableform SET name='$name', father='$father', email='$email', phone='$phone', password='$newPass' WHERE id=$id";
        }
    } else {
        $update_sql = "UPDATE tableform SET name='$name', father='$father', email='$email', phone='$phone' WHERE id=$id";
    }

    if (!empty($update_sql)) {
        if (mysqli_query($con, $update_sql)) {
            echo "<script>alert('Successfully Updated!');</script>";
        } else {
            echo "<script>alert('Error updating profile: " . mysqli_error($con) . "');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navbarStyle.css" type="text/css">
</head>
<body>
<?php include('nav.php'); ?>
<div class="settings-center">
    <div class="settings-container">
        <h2 class="settings-heading">UPDATE PROFILE</h2>
        <form method="POST">
            <div class="settings-group">
                <label for="name" class="settings-label">Full Name</label>
                <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required class="settings-input">
            </div>

            <div class="settings-group">
                <label for="fatherName" class="settings-label">Father's Name</label>
                <input type="text" id="fatherName" name="fatherName" value="<?php echo $user['father']; ?>" required class="settings-input">
            </div>

            <div class="settings-group">
                <label for="email" class="settings-label">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required class="settings-input">
            </div>

            <div class="settings-group">
                <label for="phone" class="settings-label">Phone</label>
                <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required class="settings-input">
            </div>

            <div class="settings-group">
                <label for="newPass" class="settings-label">New Password</label>
                <input type="password" id="newPass" name="newPass" class="settings-input">
            </div>

            <div class="settings-group">
                <label for="confirmPass" class="settings-label">Confirm Password</label>
                <input type="password" id="confirmPass" name="confirmPass" class="settings-input">
            </div>

            <button type="submit" class="settingsBtn" name="done">Update</button>
        </form>
    </div>
</div>
</body>
</html>
