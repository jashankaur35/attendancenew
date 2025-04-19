<?php
require_once("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['attendance'] as $student_id => $attendance_data) {
        foreach ($attendance_data as $day => $status) {
            if (!empty($status)) {
                // Build the date for each day
                $date = date("Y-m-") . str_pad($day, 2, "0", STR_PAD_LEFT);

                // Insert the attendance record
                $sql = "INSERT INTO attendance (student_id, attendance_date, status)
                        VALUES ($student_id, '$date', '$status')";

                if (!mysqli_query($con, $sql)) {
                    echo "Error saving attendance: " . mysqli_error($con) . "<br>";
                }
            }
        }
    }

    // Redirect after saving
    header("Location: attend.php");
    exit();
}
?>
