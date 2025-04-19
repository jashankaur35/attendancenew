<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navbarStyle.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/YOUR_CDN_KEY.js" crossorigin="anonymous"></script>
    <title>Navbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

</head>
<body>
<?php include('nav.php'); ?>
<form class="date-form">
<div class="todays-date"><?php echo date("d-M-Y")?>
<input type="date" name="choose_date">
</div>
</form>
<?php

?>
 <div class="container-counter">
        <div class="counter-box">
            <span id="present-count">0</span>
            <div class="label">Present</div>
        </div>
        <div class="counter-box">
            <span id="absent-count">0</span>
            <div class="label">Absent</div>
        </div>
        <div class="counter-box">
            <span id="leave-count">0</span>
            <div class="label">Leave</div>
        </div>
        <div class="counter-box">
            <span id="holiday-count">0</span>
            <div class="label">Holiday</div>
        </div>
    </div>

    <script>
        document.getElementById("present-count").innerText = 10;
        document.getElementById("absent-count").innerText = 3;
        document.getElementById("leave-count").innerText = 2;
        document.getElementById("holiday-count").innerText = 1;
    </script>