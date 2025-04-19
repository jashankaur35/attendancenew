<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/YOUR_CDN_KEY.js" crossorigin="anonymous"></script>
    <title>Navbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="navbarStyle.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <a href="#" class="logo"><i class="ri-home-heart-fill"></i><span>LOGO</span> </a>

    <ul class="navbar">
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="chatroom.php">Notification</a></li>
        <li><a href="teachers.php">Teachers</a></li>
        <li><a href="student.php">Students</a></li>
    </ul>

    <div class="main">
        <a href="registration.php">Registration</a>
        <div class="profile-container">
        <div class="profile-icon">
              <img src="profileUpload/default.png" class="profile_image">
        </div>
        <div class="dropdown-menu">
            <ul>
                <li><i class="fas fa-user"></i> <a href="#" class=""><?php echo $_SESSION['name']; ?></a></li>
                <li><i class="fas fa-tachometer-alt"></i> <a href="dashboard.php" class="">Dashboard</a></li>
                <li><i class="fas fa-cog"></i> <a href="setting.php" class="">Settings</a></li>
                <li><i class="fas fa-sign-out-alt"></i>  <a href="logout.php" class="">Logout</a></li>
            </ul>
        </div>
    </div>

        <div class="bx bx-menu" id="menu-icon"></div>
    </div>
</header>
<script>
let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
console.log("check");
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
}

</script>
</body>
</html>