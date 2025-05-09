
<?php

class user{
    private $username;
    private $password;


    public function __construct($username,$password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function getName(){
        return $this->username;
    }
    public function setName($username){
        $this->username =$username;
    }
    public function getpassword(){
        return $this->password;
    }
    public function setpassword($password){
        $this->password =$password;
    }
}
