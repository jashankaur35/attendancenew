<table border="1" cellspacing="0">
<form method="post">
    <tr>
        <th>Students Name</th>
        <th>P</th>
        <th>A</th>
        <th>L</th>
        <th>H</th>
    </tr>

    <?php
        require_once("config.php");
        $sql = "SELECT * FROM tableform";
        $fetchingStudents = mysqli_query($con, $sql);

        while($data = mysqli_fetch_assoc($fetchingStudents)){
            $student_id = $data['id'];
            $student_name = $data['name'];

    ?>
            <tr>
                <td><?php echo $student_name ?></td>
                <td><input type='checkbox' name="studentPresent[]" value="<?php echo $student_id; ?>"></td>
                <td><input type='checkbox' name="studentAbsent[]" value="<?php echo $student_id; ?>"></td>
                <td><input type='checkbox' name="studentLeave[]" value="<?php echo $student_id; ?>"></td>
                <td><input type='checkbox' name="studentHoliday[]" value="<?php echo $student_id; ?>"></td>

            </tr>

    <?php
        }
    ?>
    <tr>
        <td>Select Date(Optional)</td>
        <td colspan="4"><input type="date" name="selected_date"></td>
    </tr>
    <tr>
        <th colspan="5"><input type="submit" name="addAttendanceBtn"></th>
    </tr>

</form>
</table>

<?php
    if(isset($_POST['addAttendanceBtn'])){
        if($_POST['selected_date'] == NULL){
            $selected_date = date("Y-m-d");
        }
        else{
            $selected_date = $_POST['selected_date'];
        }
        $attendance_month = date("M", strtotime($selected_date));
        $attendance_year = date("Y", strtotime($selected_date));

        if(isset($_POST['studentPresent'])){
            $studentPresent = $_POST['studentPresent'];
            $attendance = "P";
            foreach($studentPresent as $atd){
                $que = "INSERT INTO attend(id, cur_date, attendance_month, attendance_year, attendance) VALUES('".$atd."','".$selected_date."','".$attendance_month."','".$attendance_year."','".$attendance."')";
                mysqli_query($con, $que) or die(mysqli_error($con));
            }
        }
        if(isset($_POST['studentAbsent'])){
            $studentAbsent = $_POST['studentAbsent'];
            $attendance = "A";
            foreach($studentAbsent as $atd){
                $que = "INSERT INTO attend(id, cur_date, attendance_month, attendance_year, attendance) VALUES('".$atd."','".$selected_date."','".$attendance_month."','".$attendance_year."','".$attendance."')";
                mysqli_query($con, $que) or die(mysqli_error($con));
            }
        }
        if(isset($_POST['studentLeave'])){
            $studentLeave = $_POST['studentLeave'];
            $attendance = "L";
            foreach($studentLeave as $atd){
                $que = "INSERT INTO attend(id, cur_date, attendance_month, attendance_year, attendance) VALUES('".$atd."','".$selected_date."','".$attendance_month."','".$attendance_year."','".$attendance."')";
                mysqli_query($con, $que) or die(mysqli_error($con));
            }
        }
        if(isset($_POST['studentHoliday'])){
            $studentHoliday = $_POST['studentHoliday'];
            $attendance = "H";
            foreach($studentHoliday as $atd){
                $que = "INSERT INTO attend(id, cur_date, attendance_month, attendance_year, attendance) VALUES('".$atd."','".$selected_date."','".$attendance_month."','".$attendance_year."','".$attendance."')";
                mysqli_query($con, $que) or die(mysqli_error($con));
            }
        }
        echo "Attendance added successfully!";
    }
?>