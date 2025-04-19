<?php
session_start();
include("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: {$hostname}/login.php");
    exit();
}

if (!isset($_GET['msg']) || empty($_GET['msg']) || !isset($_GET['date']) || !isset($_GET['time'])) {
    die("Missing required data");
}

$msg = mysqli_real_escape_string($con, $_GET['msg']);
$date = $_GET['date'];
$time = $_GET['time'];
$id = $_SESSION['id'];

$q = "INSERT INTO message (id, msg, message_time, message_date)
      VALUES ($id, '$msg', '$time', '$date')";

if (mysqli_query($con, $q)) {
    echo "Message saved";
} else {
    echo "Error: " . mysqli_error($con);
}
?>
