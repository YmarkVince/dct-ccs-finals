<?php    
    session_start();
    
    function openCon() {
        $conn = new mysqli("localhost", "root", "", "dct-ccs-finals");
    
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
?>
