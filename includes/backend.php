<?php 
require('database.php');
require('data.php');
class backend{
    public function doLogin($username,$password){
        return $this->login($email,$password);
    }
    public function doRegister($username,$fullname,$password,$confirmPassword,$address,$mobile,$email,$user_role,$userid){
        return $this->register($username,$fullname,$password,$confirmPassword,$address,$mobile,$email,$user_role,$userid);
    }
    private function login($username, $password)
    {
        try {
            $con = new database();
            if ($con->getStatus()) {
                $DT = new data();
                $password = md5($password);
                $query = $con->getCon()->prepare($DT->doLoginData());
                $query->execute(array($username, $password));
                $ret = null; // Initialize $ret as null
    
                while ($row = $query->fetch()) {
                    $_SESSION['userid'] = $row['userid'];
                    $_SESSION['fullname'] = $row['fullname'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['mobile'] = $row['mobile'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['role'] = $row['user_role'];
    
                    // Assign data to $ret
                    $ret[] = [
                        'ret' => $row['ret'],
                        'user_role' => (int)$row['user_role']
                    ];
                }
    
                // Check if there are no rows returned from the query
                if (empty($ret)) {
                    $con->closeConnection();
                    return ['ret' => 'No data found']; // Assign an appropriate message to $ret and return it as an array
                }
    
                // Check the role and status
                $role = $_SESSION['role'];
                $status = $ret[0]['ret'];
    
                if ($role == 1 && $status == 1) {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $con->closeConnection();
                    return 1;
                } elseif ($role == 2 && $status == 1) {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $con->closeConnection();
                    return 2;
                } elseif ($role == 0 && $status == 1) {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $con->closeConnection();
                    return 0;
                } else {
                    $con->closeConnection();
                    return 401;
                }
            }
        } catch (PDOException $th) {
            return $th; // Return the error message
        }
    }
    

    private function register($username,$fullname,$password,$confirmPassword,$address,$mobile,$email,$user_role,$userid){
        try{
            $con = new database();
            if($con->getStatus()){
                $DT = new data();
                $query = $con->getCon()->prepare($DT->doRegisterData());
                $query->execute(array($username, $fullname, md5($password), md5($confirmPassword),$address,$mobile,$email,$user_role,$userid));
                $result = $query->fetch();
                if(!$result){
                    $con->closeConnection();
                    return "Successfully";
                }else{
                    $con->closeConnection();
                    return "Try Again";
                }
            }else{
                $con->closeConnection();
                return "ERROR 404";
            }
        } catch(PDOException $th){
            return $th;
        }
    }
}
?>