<?php
include "config.php";
session_start();
if(isset($_SESSION['id'])){
    header("Location: {$hostname}/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
<body>
<div class="container">
    <div class="title">
        LOGIN
    </div>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="user-details">
            <div class="input-box">
                <span class="details">Id</span>
                <input type="number" name="id" placeholder="Enter Your id" required>
            </div>
            <div class="input-box">
                <span class="details">Password</span>
                <input type="password" name="password" placeholder="Enter Your Name" required>
            </div>
        </div>

        <div class="button">
            <input type="submit" name="login" value="login">
        </div>
    </form>
<div class="goToReg">
    <p>Don't have any account?<a href="registration.php">registration now</a></p>
</div>
    <?php
        if(isset($_POST['login'])){
            include('config.php');
            $id = mysqli_real_escape_string($con, $_POST['id']);
            $password = md5($_POST['password']);

            $sql = "SELECT * FROM tableform WHERE id= {$id} AND password = '{$password}'";
            $result = mysqli_query($con, $sql) or die("Query Failed");

            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['role'] = $row['role'];

                    header("Location: {$hostname}/index.php");
                }
            }
            else{
                echo "<div><script>alert('Id and Password are not matched');</script></div>";
            }

        }
    ?>

</div>
</body>
</html>














