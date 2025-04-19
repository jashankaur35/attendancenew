<?php

include("config.php");
session_start();
if(!isset($_SESSION['id'])){
    header("Location: {$hostname}/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration form</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    </head>
<body>


<?php
include('nav.php');
include("navbar.php");
//include("attend.php");
 //echo "<br><br><hr><br><br>";
//include("addAttendance.php");
//echo "<a href='logout.php'>logout</a>"
?>


<script>
let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
}

</script>

</body>
</html>