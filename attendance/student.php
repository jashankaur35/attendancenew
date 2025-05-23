<?php

include('config.php');
$sql = "SELECT name, id, image FROM tableform WHERE role = 0";
$result = mysqli_query($con, $sql);
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
    <style>

    </style>
</head>
<body>
<?php
    include('nav.php');
?>
<div class="center-align">
<div class="container">
<?php
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
?>
    <div class="profile-card">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" alt="User">
        <div class="info">
            <h2><?php echo $row['name']; ?></h2>
            <h3><strong>ID: </strong><?php echo $row['id']; ?></h3>
            <p>BCA 3</p>
        </div>
    </div>
    <?php
        }
    }else{
        echo "<h1>NO RECORD FOUND!</h1>";
    }
    ?>
</div>
</div>
</body>
</html>
