<?php
// Try connecting without DB first
mysqli_report(MYSQLI_REPORT_OFF); // Disable exception throwing for connection check
$conn = @mysqli_connect("localhost", "root", "");

if (!$conn) {
    die("Connection failed (root@localhost): " . mysqli_connect_error());
}

// Create DB if not exists
$firstName = "orlia";
$sql = "CREATE DATABASE IF NOT EXISTS $firstName";
if (mysqli_query($conn, $sql)) {
    echo "Database $firstName checked/created.<br>";
} else {
    die("Error creating database: " . mysqli_error($conn));
}

// Select DB
if (!mysqli_select_db($conn, $firstName)) {
    die("Error selecting database: " . mysqli_error($conn));
}

// Create events table (Config)
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
    echo "Table events created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// List of events
$events = [
    // Day 1 Solo
    ['Tamilspeech', 'Tamil Speech', 'Non-Technical', 'Solo', 'day1'],
    ['Englishspeech', 'English Speech', 'Non-Technical', 'Solo', 'day1'],
    ['Singing', 'Singing', 'Non-Technical', 'Solo', 'day1'],
    ['Memecreation', 'Meme Creation', 'Non-Technical', 'Solo', 'day1'],
    ['Solodance', 'Solo Dance', 'Non-Technical', 'Solo', 'day1'],
    ['Drawing', 'Drawing', 'Non-Technical', 'Solo', 'day1'],
    ['Mehandi', 'Mehandi', 'Non-Technical', 'Solo', 'day1'],

    // Day 1 Group
    ['Divideconquer', 'Divide Conquer', 'Technical', 'Group', 'day1'],
    ['Trailertime', 'Trailer Time', 'Non-Technical', 'Group', 'day1'],
    ['Groupdance', 'Group Dance', 'Non-Technical', 'Group', 'day1'],
    ['Firelesscooking', 'Fireless Cooking', 'Non-Technical', 'Group', 'day1'],
    ['Dumpcharades', 'Dump Charades', 'Non-Technical', 'Group', 'day1'],
    ['Iplauction', 'IPL Auction', 'Non-Technical', 'Group', 'day1'],
    ['Lyricalhunt', 'Lyrical Hunt', 'Non-Technical', 'Group', 'day1'],

    // Day 2 Solo
    ['Shortflim', 'Short Film', 'Non-Technical', 'Solo', 'day2'],
    ['Bestmanager', 'Best Manager', 'Non-Technical', 'Solo', 'day2'],
    ['Instrumentalplaying', 'Instrumental Playing', 'Non-Technical', 'Solo', 'day2'],
    ['Rjvj', 'RJ/VJ Hunt', 'Non-Technical', 'Solo', 'day2'],
    ['Photography', 'Photography', 'Non-Technical', 'Solo', 'day2'],

    // Day 2 Group
    ['Artfromwaste', 'Art From Waste', 'Non-Technical', 'Group', 'day2'],
    ['Twindance', 'Twin Dance', 'Non-Technical', 'Group', 'day2'],
    ['Vegetablefruitart', 'Vegetable Fruit Art', 'Non-Technical', 'Group', 'day2'],
    ['Rangoli', 'Rangoli', 'Non-Technical', 'Group', 'day2'],
    ['Sherlockholmes', 'Sherlock Holmes', 'Non-Technical', 'Group', 'day2'],
    ['Freefire', 'Free Fire', 'Non-Technical', 'Group', 'day2'],
    
    // Both (Mime) - Day 2
    ['Mime', 'Mime', 'Non-Technical', 'Both', 'day2']
];

foreach ($events as $event) {
    $key = $event[0];
    $name = $event[1];
    $cat = $event[2];
    $type = $event[3];
    $day = $event[4];
    
    // Insert or Update
    $stmt = "INSERT INTO events (event_key, event_name, event_category, event_type, day, status) 
             VALUES ('$key', '$name', '$cat', '$type', '$day', 1)
             ON DUPLICATE KEY UPDATE event_name='$name', event_category='$cat', event_type='$type', day='$day'";
             
    if (mysqli_query($conn, $stmt)) {
        echo "Event '$name' processed.<n>";
    } else {
        echo "Error: " . mysqli_error($conn) . "<n>";
    }
}

echo "Setup Complete.";
?>