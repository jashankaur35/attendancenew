<?php
session_start();
include("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: {$hostname}/login.php");
    exit();
}

$id = $_SESSION['id'];


$sql = "SELECT name FROM tableform WHERE id = $id";
$result = mysqli_query($con, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['name'] = $row['name'];
}


$current_date = date("d M, Y");

?>

<?php include('nav.php'); ?>
<section class="chat-box-container">
    <div class="chat-container">
        <div class="chat-header">Welcome <?php echo $_SESSION['name']; ?></div>
        <div class="chat-box" id="chat-box">

            <?php

            //$query = "SELECT * FROM message WHERE id = $id ORDER BY message_date ASC, mid ASC";
            $query = "SELECT m.*, u.name FROM message m
          JOIN tableform u ON m.id = u.id
          ORDER BY m.message_date ASC, m.mid ASC";

            $messages = mysqli_query($con, $query);

            $last_date = "";

            while ($msg = mysqli_fetch_assoc($messages)) {
                $msg_date = date("d M, Y", strtotime($msg['message_date']));

                if ($msg_date != $last_date) {
                    echo "<center><div class='display-date'>$msg_date</div></center>";
                    $last_date = $msg_date;
                }
                    $only_time = date("h:i A", strtotime($msg['message_time']));

                    echo "<div class='message-container'>
                        <div class='message-sender'>{$msg['name']}:</div>
                        <div class='message'>{$msg['msg']}</div>
                        <div class='display-time'>$only_time</div>
                    </div>";


            }
            ?>
        </div>

        <div class="input-container">
            <input type="text" id="input_msg" name="message" placeholder="Type your message...">
            <button id="sendButton">Send</button>
        </div>
    </div>
</section>

<script>
document.getElementById("sendButton").addEventListener("click", update);
document.getElementById("input_msg").addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        update();
    }
});

function update() {
    let msg = document.getElementById("input_msg").value.trim();

    if (msg === "") {
        alert("Message cannot be empty");
        return;
    }

    let currentTime = new Date().toLocaleTimeString();
    let currentDate = new Date().toISOString().split('T')[0];

setInterval(()=>{

    fetch(`adminmsg.php?msg=${encodeURIComponent(msg)}&time=${encodeURIComponent(currentTime)}&date=${encodeURIComponent(currentDate)}`)
    .then(response => response.text())
    .then(data => {
        console.log("Message added:", data);
        document.getElementById("input_msg").value = "";

        // Reload the page to show the new message under the correct date
        location.reload();
    })
    .catch(error => console.error("Error:", error));
},500);

}
</script>

</body>
</html>
