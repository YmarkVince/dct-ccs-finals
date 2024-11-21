<?php    
    session_start();
    
    function openCon() {
        $conn = new mysqli("localhost", "root", "", "dct-ccs-finals");
    
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function closeCon($conn) {
        $conn->close();
    }

    function loginUser($username, $password) {
        $conn = openCon();
    
       
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
    
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
    
           
            if (password_verify($password, $user['password'])) {
               
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_id'] = $user['id'];
    
                
                $stmt->close();
                closeCon($conn);
                return true;
            }
        }
    
       
        $stmt->close();
        closeCon($conn);
        return false;
    }
?>
