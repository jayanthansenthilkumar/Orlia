<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orlia";

// Create connection to server (no DB selected yet)
$conn = @mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysqli_query($conn, $sql)) {
    echo "Database '$dbname' verified successfully.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select database
if (!mysqli_select_db($conn, $dbname)) {
    die("Error selecting database: " . mysqli_error($conn));
}

// 1. Create `soloevents` table
$sql = "CREATE TABLE IF NOT EXISTS `soloevents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `events` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($conn, $sql)) {
    echo "Table 'soloevents' created successfully.<br>";
} else {
    echo "Error creating table 'soloevents': " . mysqli_error($conn) . "<br>";
}

// 2. Create `groupevents` table
$sql = "CREATE TABLE IF NOT EXISTS `groupevents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamname` varchar(255) NOT NULL,
  `teamleadname` varchar(255) NOT NULL,
  `tregno` varchar(255) NOT NULL,
  `temail` varchar(255) NOT NULL,
  `events` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'Group',
  `tmembername` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`tmembername`)),
  `year` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($conn, $sql)) {
    echo "Table 'groupevents' created successfully.<br>";
} else {
    echo "Error creating table 'groupevents': " . mysqli_error($conn) . "<br>";
}

// 3. Create `users` table
$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($conn, $sql)) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table 'users': " . mysqli_error($conn) . "<br>";
}

// Populate `users` table
$check = mysqli_query($conn, "SELECT * FROM users WHERE userid = 'superadmin'");
if (mysqli_num_rows($check) == 0) {
    $admins = [
        [1, 'admin', '123456@', '0'],
        [2, 'admin123', '123456@', '0'],
        [3, 'Iplauction', '123', '1'],
        [4, 'Groupdance', '123', '1'],
        [5, 'Divideconquer', '123', '1'],
        [6, 'Firelesscooking', '123', '1'],
        [7, 'Trailertime', '123', '1'],
        [8, 'Lyricalhunt', '123', '1'],
        [9, 'Dumpcharades', '123', '1'],
        [10, 'Rangoli', '123', '1'],
        [11, 'Sherlockholmes', '123', '1'],
        [12, 'Freefire', '123', '1'],
        [13, 'Treasurehunt', '123', '1'],
        [14, 'Artfromwaste', '123', '1'],
        [15, 'Twindance', '123', '1'],
        [16, 'Mime', '123', '1'],
        [17, 'Tamilspeech', '123', '1'],
        [18, 'Englishspeech', '123', '1'],
        [19, 'Singing', '123', '1'],
        [20, 'Drawing', '123', '1'],
        [21, 'Mehandi', '123', '1'],
        [22, 'Memecreation', '123', '1'],
        [23, 'Solodance', '123', '1'],
        [24, 'Photography', '123', '1'],
        [25, 'Bestmanager', '123', '1'],
        [26, 'Instrumentalplaying', '123', '1'],
        [27, 'Rjvj', '123', '1'],
        [28, 'Shortflim', '123', '1'],
        [29, 'superadmin', '12345.#', '2'],
        [30, 'Vegetablefruitart', '123', '1']
    ];

    foreach ($admins as $admin) {
        $id = $admin[0];
        $userid = mysqli_real_escape_string($conn, $admin[1]);
        $password = mysqli_real_escape_string($conn, $admin[2]);
        $role = mysqli_real_escape_string($conn, $admin[3]);

        $sql = "INSERT INTO users (userid, password, role) VALUES ('$userid', '$password', '$role')";
        mysqli_query($conn, $sql);
    }
    echo "Users table populated.<br>";
} else {
    echo "Users table already populated.<br>";
}

// 4. Create `events` table (Configuration)
$sql = "CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_key` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_category` varchar(50) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_key` (`event_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if (mysqli_query($conn, $sql)) {
    echo "Table 'events' verified.<br>";
}

// Populate `events` if empty
$checkEvents = mysqli_query($conn, "SELECT COUNT(*) as count FROM events");
$row = mysqli_fetch_assoc($checkEvents);
if ($row['count'] == 0) {
    // List of events (Same as before)
    $events = [
        ['Tamilspeech', 'Tamil Speech', 'Non-Technical', 'Solo', 'day1'],
        ['Englishspeech', 'English Speech', 'Non-Technical', 'Solo', 'day1'],
        ['Singing', 'Singing', 'Non-Technical', 'Solo', 'day1'],
        ['Memecreation', 'Meme Creation', 'Non-Technical', 'Solo', 'day1'],
        ['Solodance', 'Solo Dance', 'Non-Technical', 'Solo', 'day1'],
        ['Divideconquer', 'Divide Conquer', 'Technical', 'Group', 'day1'],
        ['Trailertime', 'Trailer Time', 'Non-Technical', 'Group', 'day1'],
        ['Groupdance', 'Group Dance', 'Non-Technical', 'Group', 'day1'],
        ['Shortflim', 'Short Film', 'Non-Technical', 'Solo', 'day2'],
        ['Bestmanager', 'Best Manager', 'Non-Technical', 'Solo', 'day2'],
        ['Instrumentalplaying', 'Instrumental Playing', 'Non-Technical', 'Solo', 'day2'],
        ['Rjvj', 'RJ/VJ Hunt', 'Non-Technical', 'Solo', 'day2'],
        ['Artfromwaste', 'Art From Waste', 'Non-Technical', 'Group', 'day2'],
        ['Twindance', 'Twin Dance', 'Non-Technical', 'Group', 'day2'],
        ['Vegetablefruitart', 'Vegetable Fruit Art', 'Non-Technical', 'Group', 'day2'],
        ['Mime', 'Mime', 'Non-Technical', 'Both', 'day2']
    ];

    foreach ($events as $event) {
        $key = $event[0];
        $name = $event[1];
        $cat = $event[2];
        $type = $event[3];
        $day = $event[4];

        $sql = "INSERT INTO events (event_key, event_name, event_category, event_type, day, status) 
                VALUES ('$key', '$name', '$cat', '$type', '$day', 1)";
        mysqli_query($conn, $sql);
    }
    echo "Event config populated.<br>";
} else {
    echo "Event config already exists.<br>";
}

echo "Schema setup completed successfully.";
mysqli_close($conn);
?>