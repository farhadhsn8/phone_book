<?php

include_once 'db.php';

class user extends db
{ //baraye estefade az method haye pedar
    protected $tbl='user_tbl';

    
    public function login($data){
        $email=$data['email'];
        $password=$data['password'];
        $this->set_tbl($this->tbl);
        $user_data=$this->search_data('email', $email);
        // var_dump($user_data);die;
        // var_dump($this->salam("farhad"));die;
        if($password==$user_data->password){
            session_start();
            $_SESSION['name']=$user_data->name;
            header('location:dashbord.php');
        }
    }
    public function logout(){
        session_destroy();
        header("location:index.php?logout=ok");
    }
}