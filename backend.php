<?php
include "db.php";

if (isset($_POST['Add_newuser'])) {
    try {
        $name = mysqli_real_escape_string($conn, $_POST['fullName']);
        $rollno = mysqli_real_escape_string($conn, $_POST['rollNumber']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $mail = mysqli_real_escape_string($conn, $_POST['mailid']);
        $phoneno = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $dept = mysqli_real_escape_string($conn, $_POST['department']);
        $day = mysqli_real_escape_string($conn, $_POST['daySelection']);
        $events = mysqli_real_escape_string($conn, $_POST['events']);


        $query = "INSERT INTO events (name, regno, year, phoneno, dept, day, events, mail) VALUES ('$name', '$rollno', '$year', '$phoneno', '$dept', '$day', '$events','$mail')";
        if (mysqli_query($conn, $query)) {
            $res = [
                'status' => 200,
                'message' => 'Event register Successfully'
            ];
            echo json_encode($res);
        } else {
            throw new Exception('Query Failed: ' . mysqli_error($conn));
        }
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}

if (isset($_POST['groupnewuser'])) {
    $teamname = mysqli_real_escape_string($conn, $_POST['TeamName']);
    $teamleadname = mysqli_real_escape_string($conn, $_POST['fullName']);
    $tregno = mysqli_real_escape_string($conn, $_POST['rollNumber']);
    $temail = mysqli_real_escape_string($conn, $_POST['mailid']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $phoneno = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $dept = mysqli_real_escape_string($conn, $_POST['department']);
    $day = mysqli_real_escape_string($conn, $_POST['daySelection']);
    $events = mysqli_real_escape_string($conn, $_POST['events']);

    // Collect team members in an array
    $teamMembers = [];
    $teamMembersCount = $_POST['teamMembersCount'] ?? 0;

    for ($i = 1; $i <= $teamMembersCount; $i++) {
        if (!empty($_POST["memberName$i"]) && !empty($_POST["memberRoll$i"])) {
            $teamMembers[] = [
                'name' => $_POST["memberName$i"],
                'roll' => $_POST["memberRoll$i"]
            ];
        }
    }

    // Convert team members array to JSON
    $tmember_json = json_encode($teamMembers, JSON_UNESCAPED_UNICODE);

    $query = "INSERT INTO groupevents (teamname, teamleadname, tregno, temail, tmembername, year, phoneno, dept, day, events) VALUES ('$teamname', '$teamleadname', '$tregno', '$temail', '$tmember_json', '$year', '$phoneno', '$dept', '$day', '$events')";
    if (mysqli_query($conn, $query)) {
        $res = [
            'status' => 200,
            'message' => 'Event register Successfully'
        ];
        echo json_encode($res);
    } else {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . mysqli_error($conn)
        ];
        echo json_encode($res);
    }
}
?>
