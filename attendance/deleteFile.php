<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['file_name'])) {
    $file_name = $_POST['file_name'];
    $file_path = "uploadFiles/" . $file_name;

    // Delete file from server
    if (file_exists($file_path)) {
        unlink($file_path); // Deletes the file
    }

    // Remove entry from database
    $sql = "DELETE FROM uploadedfiles WHERE fileName = '$file_name'";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('File deleted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error deleting file: " . mysqli_error($con) . "');</script>";
    }
}
?>
