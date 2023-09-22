<?php 
require('database.php');
require('data.php');
class backend{
    public function doLogin($email,$password){
        return $this->login($email,$password);
    }
    public function doRegister($name,$email,$password,$role){
        return $this->register($name,$email,$password,$role);
    }
    private function login($email,$password){
        try{
            $con = new database();
            if($con->getStatus()){
                $DT = new data();
                $password = md5($password);
                $query = $con->getCon()->prepare($DT->doLoginData());
                $query->execute(array($email,$password));
                $role = null;
                $status = null;
                
                while($row = $query->fetch()){
                    $role = $row['role'];
                    $status = $row['status'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['image'] = $row['image'];
                }

                if($role == '1'){
                    if($status == '1'){
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        $con->closeConnection();
                        return 1;
                    }
                }else if($role == '2'){
                    if($status == '1'){
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        $con->closeConnection();
                        return 2;
                    }
                }else if($role == '0'){
                    if($status == '1'){
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        $con->closeConnection();
                        return 0;
                    }
                }else{
                        return 401;
                }
            }
        } catch(PDOException $th){
            return $th;
        }
    }

    private function register($name,$email,$password,$role){
        try{
            $con = new database();
            if($con->getStatus()){
                $DT = new data();
                $query = $con->getCon()->prepare($DT->doRegisterData());
                $query->execute(array($name, $email, md5($password), $role));
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