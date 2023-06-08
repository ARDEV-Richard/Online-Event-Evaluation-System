<?php
class FetchParticipantTable {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    function FetchParticipantTable(){ 
    $sql= "SELECT *, CONCAT(first_name, ' ', last_name) AS full_name  FROM `users` WHERE Role='Participant' ORDER BY UserID DESC;";
    $result = mysqli_query($this->conn, $sql);
    return $result;
}
}

?>
