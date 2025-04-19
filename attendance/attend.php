<?php
echo "<link rel='stylesheet' href='attendStyle.css'>";
require_once("config.php");
date_default_timezone_set("Asia/Kolkata");

// Get first day and total days of the current month
$firstDayOfMonth = date("1-m-Y");
$totalDaysInMonth = date("t", strtotime($firstDayOfMonth));

// ✅ Only fetch students with role = 0
$sql = "SELECT * FROM tableform WHERE role = 0";
$fetchingStudents = mysqli_query($con, $sql);

$totalNumberOfStudents = mysqli_num_rows($fetchingStudents);

$studentNamesArray = array();
$studentIdsArray = array();
$count = 0;

while ($students = mysqli_fetch_assoc($fetchingStudents)) {
    $studentNamesArray[] = $students['name'];
    $studentIdsArray[] = $students['id'];
}
?>

<div class="sidebar">
    <h3>Menu</h3>
    <a href="attend.php" class="option">📋 Attendance</a>
    <a href="index.php" class="option">📂 Work</a>
</div>

<?php include('nav.php'); ?>

<div class="attendance-container">
    <center><h1 class="heading-attendance">ATTENDANCE MANAGEMENT SHEET</h1></center>
    <h3 class="month-attendance">STUDENTS ATTENDANCE MONTH:
        <u><font color="red"><?php echo strtoupper(date("F", strtotime($firstDayOfMonth))); ?></font></u>
    </h3>

    <form action="saveAttendance.php" method="post">
        <table border="1" cellspacing="0" class="table-attendance">
            <?php
                // Render the header row with day numbers
                echo "<tr><td rowspan='2'>Name</td>";
                for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                    echo "<td>$j</td>";
                }
                echo "</tr>";

                // Render the day of the week row
                echo "<tr>";
                for ($j = 0; $j < $totalDaysInMonth; $j++) {
                    $dayOfMonth = strtotime("+$j Days", strtotime($firstDayOfMonth));
                    echo "<td>" . date("D", $dayOfMonth) . "</td>";
                }
                echo "</tr>";

                // Render each student's row with attendance dropdowns
                foreach ($studentIdsArray as $index => $student_id) {
                    echo "<tr><td>" . $studentNamesArray[$index] . "</td>";

                    for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                        $date = date("Y-m-") . str_pad($j, 2, "0", STR_PAD_LEFT);

                        // Fetch existing attendance from the database
                        $check_sql = "SELECT status FROM attendance WHERE student_id = $student_id AND attendance_date = '$date'";
                        $result = mysqli_query($con, $check_sql);
                        $row = mysqli_fetch_assoc($result);
                        $selectedStatus = $row['status'] ?? '';

                        echo "<td>
                            <select name='attendance[{$student_id}][$j]'>
                                <option value='' " . ($selectedStatus == '' ? 'selected' : '') . "></option>
                                <option value='P' " . ($selectedStatus == 'P' ? 'selected' : '') . ">P</option>
                                <option value='A' " . ($selectedStatus == 'A' ? 'selected' : '') . ">A</option>
                                <option value='L' " . ($selectedStatus == 'L' ? 'selected' : '') . ">L</option>
                                <option value='H' " . ($selectedStatus == 'H' ? 'selected' : '') . ">H</option>
                            </select>
                        </td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>

        <center><button type="submit" class="saveBtn">Save</button></center>
    </form>
</div>
