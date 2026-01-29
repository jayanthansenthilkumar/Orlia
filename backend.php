<?php
session_start();
include "db.php";

// Set header for JSON response
header('Content-Type: application/json');

function sendResponse($status, $message, $data = null)
{
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

function checkAdminAuth()
{
    if (!isset($_SESSION['username'])) {
        sendResponse(403, 'Unauthorized Access');
    }
}

// 1. Add New User (Public Event Registration)
if (isset($_POST['Add_newuser'])) {
    try {
        $stmt = $conn->prepare("INSERT INTO events (name, regno, year, phoneno, dept, day, events, mail) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssss",
            $_POST['fullName'],
            $_POST['rollNumber'],
            $_POST['year'],
            $_POST['phoneNumber'],
            $_POST['department'],
            $_POST['daySelection'],
            $_POST['events'],
            $_POST['mailid']
        );

        if ($stmt->execute()) {
            sendResponse(200, 'Event register Successfully');
        } else {
            throw new Exception('Query Failed: ' . $stmt->error);
        }
    } catch (Exception $e) {
        sendResponse(500, 'Error: ' . $e->getMessage());
    }
}

// 2. Group Registration (Public)
if (isset($_POST['groupnewuser'])) {
    try {
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

        $tmember_json = json_encode($teamMembers, JSON_UNESCAPED_UNICODE);

        $stmt = $conn->prepare("INSERT INTO groupevents (teamname, teamleadname, tregno, temail, tmembername, year, phoneno, dept, day, events) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssssss",
            $_POST['TeamName'],
            $_POST['fullName'],
            $_POST['rollNumber'],
            $_POST['mailid'],
            $tmember_json,
            $_POST['year'],
            $_POST['phoneNumber'],
            $_POST['department'],
            $_POST['daySelection'],
            $_POST['events']
        );

        if ($stmt->execute()) {
            sendResponse(200, 'Event register Successfully');
        } else {
            throw new Exception('Query Failed: ' . $stmt->error);
        }
    } catch (Exception $e) {
        sendResponse(500, 'Error: ' . $e->getMessage());
    }
}

// 3. Add Admin (Protected)
if (isset($_POST['Addadmins'])) {
    checkAdminAuth();
    try {
        // Note: Password hashing explicitly skipped as per user instructions ("except password hashing")
        $stmt = $conn->prepare("INSERT INTO login(userid, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $_POST['userid'], $_POST['password'], $_POST['role']);

        if ($stmt->execute()) {
            sendResponse(200, 'User Added Successfully');
        } else {
            throw new Exception('Query Failed: ' . $stmt->error);
        }
    } catch (Exception $e) {
        sendResponse(500, 'Error: ' . $e->getMessage());
    }
}

// 4. Delete User (Protected)
if (isset($_POST['delete_user'])) {
    checkAdminAuth();
    try {
        $stmt = $conn->prepare("DELETE FROM login WHERE id=?");
        $stmt->bind_param("i", $_POST['userid']);

        if ($stmt->execute()) {
            sendResponse(200, 'Details Deleted Successfully');
        } else {
            sendResponse(500, 'Details Not Deleted');
        }
    } catch (Exception $e) {
        sendResponse(500, 'Error: ' . $e->getMessage());
    }
}

// 5. Fetch User for Edit (Protected)
if (isset($_POST['edit_user'])) {
    checkAdminAuth();
    try {
        $stmt = $conn->prepare("SELECT * FROM login WHERE id=?");
        $stmt->bind_param("i", $_POST['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if ($data) {
            sendResponse(200, 'details Fetch Successfully by id', $data);
        } else {
            sendResponse(500, 'User not found');
        }
    } catch (Exception $e) {
        sendResponse(500, 'Error: ' . $e->getMessage());
    }
}

// 6. Save Edited User (Protected)
if (isset($_POST['save_edituser'])) {
    checkAdminAuth();
    try {
        $stmt = $conn->prepare("UPDATE login SET userid=?, password=?, role=? WHERE id=?");
        $stmt->bind_param(
            "sssi",
            $_POST['userid'],
            $_POST['password'],
            $_POST['role'],
            $_POST['id']
        );

        if ($stmt->execute()) {
            sendResponse(200, 'details Updated Successfully');
        } else {
            sendResponse(500, 'Details Not Updated');
        }
    } catch (Exception $e) {
        sendResponse(500, 'Error: ' . $e->getMessage());
    }
}
// 7. Toggle Event Status (Protected)
if (isset($_POST['toggle_event_status'])) {
    checkAdminAuth();
    try {
        $stmt = $conn->prepare("UPDATE event_status SET status=? WHERE id=?");
        $stmt->bind_param("si", $_POST['new_status'], $_POST['event_id']);

        if ($stmt->execute()) {
            sendResponse(200, 'Event Status Updated Successfully');
        } else {
            sendResponse(500, 'Status Not Updated');
        }
    } catch (Exception $e) {
        sendResponse(500, 'Error: ' . $e->getMessage());
    }
}
?>