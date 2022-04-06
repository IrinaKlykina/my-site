<?php

namespace model;

class User
{
    public $age;
    public $name;
    public $login;
    public $password;
    public $confirmPassword;
    public $gender;

    public function __construct($post)
    {
        $this->password =  $post['password'];
        $this->confirmPassword = $post['confirmPassword'];
        $this->age = $post['age'];
        $this->name = $post['name'];
        $this->login = $post['login'];
        $this->gender = $post['gender'];
    }
}
?>