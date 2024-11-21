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
    
    function debugLog($message) {
        error_log("[DEBUG] " . $message);
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
    
    function isLoggedIn() {
        return isset($_SESSION['email']);
    }
    
    function addUser() {
        $conn = openCon();
    
        if ($conn) {
   
            $email = 'user2@gmail.com';
            $password = 'password';
            $name = 'user2';
            
        
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
    
      
            $sql = "INSERT INTO users (email, password, name) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $email, $hashedPassword, $name); 
    
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
    
            $stmt->close();
            closeCon($conn);
        } else {
            echo "Failed to connect to the database.";
        }
    }

    function addSubject($subjectCode, $subjectName) {
        $conn = openCon();
        

        $sql = "INSERT INTO subjects (subject_code, subject_name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $subjectCode, $subjectName);
        

        if ($stmt->execute()) {
            debugLog("Subject added: $subjectCode - $subjectName");
        } else {
            debugLog("Error adding subject: " . $stmt->error);
        }

        $stmt->close();
        closeCon($conn);
    }
    ?>