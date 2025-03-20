<?php
include "db.php";

if (isset($_POST['Add_newuser'])) {
    try {
        $name = mysqli_real_escape_string($conn, $_POST['fullName']);
        $rollno = mysqli_real_escape_string($conn, $_POST['rollNumber']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $phoneno = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $dept = mysqli_real_escape_string($conn, $_POST['department']);
        $day = mysqli_real_escape_string($conn, $_POST['daySelection']);
        $events = mysqli_real_escape_string($conn, $_POST['events']);

        // Check the count of registrations for the selected day
        $checkQuery = "SELECT COUNT(*) AS total FROM events WHERE day = '$day' and regno = '$rollno'";
        $checkResult = mysqli_query($conn, $checkQuery);
        $row = mysqli_fetch_assoc($checkResult);

        if ($row['total'] >= 3) {
            $res = [
                'status' => 400,
                'message' => 'Registration limit for this day has been reached (Max 3 events per day).'
            ];
            echo json_encode($res);
        } else {
            $query = "INSERT INTO events (name, regno, year, phoneno, dept, day, events) VALUES ('$name', '$rollno', '$year', '$phoneno', '$dept', '$day', '$events')";
            if (mysqli_query($conn, $query)) {
                $res = [
                    'status' => 200,
                    'message' => 'Event register Successfully'
                ];
                echo json_encode($res);
            } else {
                throw new Exception('Query Failed: ' . mysqli_error($conn));
            }
        }
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}
?>
