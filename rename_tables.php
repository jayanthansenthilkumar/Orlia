<?php
include 'db.php';

// Function to rename table if it exists
function renameTable($conn, $oldName, $newName)
{
    // Check if old table exists
    $checkOld = mysqli_query($conn, "SHOW TABLES LIKE '$oldName'");
    $oldExists = mysqli_num_rows($checkOld) > 0;

    // Check if new table already exists
    $checkNew = mysqli_query($conn, "SHOW TABLES LIKE '$newName'");
    $newExists = mysqli_num_rows($checkNew) > 0;

    if ($oldExists && !$newExists) {
        $sql = "RENAME TABLE `$oldName` TO `$newName`";
        if (mysqli_query($conn, $sql)) {
            echo "Renamed '$oldName' to '$newName'.<br>";
        } else {
            echo "Error renaming '$oldName': " . mysqli_error($conn) . "<br>";
        }
    } elseif ($newExists) {
        echo "Table '$newName' already exists.<br>";
    } else {
        echo "Table '$oldName' not found.<br>";
    }
}

// 1. events -> soloevents
renameTable($conn, 'events', 'soloevents');

// 2. event_config -> events
renameTable($conn, 'event_config', 'events');

// 3. login -> users
renameTable($conn, 'login', 'users');

echo "Table renaming process completed.";
?>
