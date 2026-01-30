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

        // Check Event Status
        $statusQuery = "SELECT status FROM events WHERE event_key='$events'";
        $statusResult = mysqli_query($conn, $statusQuery);
        if ($statusResult && mysqli_num_rows($statusResult) > 0) {
            $statusRow = mysqli_fetch_assoc($statusResult);
            if ($statusRow['status'] == 0) {
                echo json_encode(['status' => 403, 'message' => 'Registration for this event is closed.']);
                exit;
            }
        }

        $query = "INSERT INTO soloevents (name, regno, year, phoneno, dept, day, events, mail) VALUES ('$name', '$rollno', '$year', '$phoneno', '$dept', '$day', '$events','$mail')";
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

    // Check Event Status
    $statusQuery = "SELECT status FROM events WHERE event_key='$events'";
    $statusResult = mysqli_query($conn, $statusQuery);
    if ($statusResult && mysqli_num_rows($statusResult) > 0) {
        $statusRow = mysqli_fetch_assoc($statusResult);
        if ($statusRow['status'] == 0) {
            echo json_encode(['status' => 403, 'message' => 'Registration for this event is closed.']);
            exit;
        }
    }

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

if (isset($_POST['Addadmins'])) {
    try {

        $userid = mysqli_real_escape_string($conn, $_POST['userid']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);


        // ✅ Step 6: Insert Data into Database
        $query = "INSERT INTO users(userid, password, role ) VALUES ('$userid','$password','$role')";
        if (mysqli_query($conn, $query)) {
            $res = [
                'status' => 200,
                'message' => 'User Added Successfully'
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

if (isset($_POST['delete_user'])) {
    $id = mysqli_real_escape_string($conn, $_POST['userid']);
    $query = "DELETE FROM users WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['edit_user'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "SELECT * FROM users WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    $User_data = mysqli_fetch_array($query_run);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $User_data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['save_edituser'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['id']);
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);


    $query = "UPDATE users SET userid='$userid', password='$password' , role='$role' WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE userid='$username' AND password='$password'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_array($query_run);

        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['userid'] = $row['userid'];
        $_SESSION['role'] = $row['role'];

        $res = [
            'status' => 200,
            'message' => 'Login Successful',
            'redirect' => $row['role'] == 'event' ? 'eventAdmin.php' : ($row['role'] == 'super' ? 'superAdmin.php' : 'adminDashboard.php')
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 401,
            'message' => 'Invalid Username or Password'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['update_event_status'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "UPDATE events SET status='$status' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 200, 'message' => 'Status updated']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Error updating status']);
    }
}

if (isset($_POST['update_event_details'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $day = mysqli_real_escape_string($conn, $_POST['day']);

    $query = "UPDATE events SET event_name='$name', event_category='$category', event_type='$type', day='$day' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 200, 'message' => 'Event details updated successfully']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Error updating event details: ' . mysqli_error($conn)]);
    }
}
if (isset($_GET['get_events'])) {
    $day = mysqli_real_escape_string($conn, $_GET['day']);
    $type = mysqli_real_escape_string($conn, $_GET['type']);

    // Ensure we select only active events or handle status logic if needed. 
    // For now, listing all events matching day and type.
    $query = "SELECT event_name, event_key FROM events WHERE day='$day' AND event_type='$type'";
    $query_run = mysqli_query($conn, $query);

    $events = [];
    if ($query_run && mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $events[] = [
                'text' => $row['event_name'],
                'value' => $row['event_key']
            ];
        }
    }
    echo json_encode($events);
    exit; // Important to stop further output
}
?>