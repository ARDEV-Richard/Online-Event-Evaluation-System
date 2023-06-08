<?php
$total_student= [];
$sql = "SELECT * FROM users WHERE Role = 'Participant'"; 
include '../../config/config.php';
$user = $conn->query($sql);

if ($user->num_rows > 0) {
    while ($row = $user->fetch_assoc()) {
        $total_student[] = $row['Role'];
    }
}


$sql = "SELECT COUNT(*) as total_events FROM events WHERE EventID";
include '../../config/config.php';
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_events = $row['total_events'];
} else {
    echo "No events found.";
}

?>
