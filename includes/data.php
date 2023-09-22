<?php
class data{
    public function doLoginData(){
        return $this->loginData();
    }

    public function doRegisterData(){
        return $this->registerData();
    }
    private function loginData(){
        return "SELECT * FROM `user_table` WHERE `email` = ? AND `password` = ?";
    }

    private function registerData(){
        return "INSERT INTO `user_table` (`name`,`email`,`password`,`role`,`status`,`image`) VALUES (?,?,?,?, 1,'defaultProfilePicture.jpg' )";
    }
}
?>