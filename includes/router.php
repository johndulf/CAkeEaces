<?php
    session_start();
    require("backend.php");

    $method = $_POST['method'];
    if(function_exists($method)){
        call_user_func($method);
    }
    else{
        echo 'Function not exist';
    }

    function Login(){
        $backend = new backend();
        echo $backend->doLogin($_POST['username'],$_POST['password']);
    }

    function Register(){
        $backend = new backend();
        echo $backend->doRegister($_POST['username'],$_POST['fullname'],$_POST['password'],$_POST['confirmPassword'],$_POST['address'],$_POST['mobile'],$_POST['email'],$_POST['user_role'],$_POST['userid']);
    }

?>