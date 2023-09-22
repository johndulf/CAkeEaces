<?php
class data{
    public function doLoginData(){
        return $this->loginData();
    }

    public function doRegisterData(){
        return $this->registerData();
    }
    private function loginData(){
        return    
        $query = $con->prepare("call sp_login(?,?)");
        $query->bind_param('ss',$username,$password);
        $query->execute();
    }

    private function registerData(){
        // Initialize variables
        $existing_username_count = 0;
        $existing_username_password_count = 0;
    
        // Check if $userid is defined (you should have $userid defined somewhere before this function)
        // If $userid is not defined, you should define it appropriately
    
        if ($userid == 0) {
            // Assuming $con is a valid database connection
    
            // Check if the same username exists but with a different password
            $query = $con->prepare('SELECT COUNT(*) FROM tbl_users WHERE username = ? AND password <> ?');
            $query->bind_param('ss', $username, $password);
            $query->execute();
            $query->bind_result($existing_username_count);
            $query->fetch();
            $query->close();
        
            // Check if the same username and password combination exists
            $query = $con->prepare('SELECT COUNT(*) FROM tbl_users WHERE username = ? AND password = ?');
            $query->bind_param('ss', $username, $password);
            $query->execute();
            $query->bind_result($existing_username_password_count);
            $query->fetch();
            $query->close();
        }
    
        // If the same username but different password exists, return "exists_username"
        if ($existing_username_count > 0 && $existing_username_password_count == 0) {
            echo "exists_username";
            exit;
        }
    
        // If the same username and password combination exists, return "exists_username_password"
        if ($existing_username_password_count > 0) {
            echo "exists_username_password";
            exit;
        }
    
        // Save/Update the user
        $query = $con->prepare('CALL sp_save(?,?,?,?,?,?,?,?)');
        $query->bind_param('issssssi', $userid, $fullname, $username, $password, $address, $mobile, $email, $user_role);
    
        if ($query->execute()) {
            echo 1;
        } else {
            echo "There was an error: " . $query->error;
        }
    }
    
?>