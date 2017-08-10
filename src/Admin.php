<?php

class Admin
{
    const table = "Admins";

    public $id;
    public $email;
    public $password;

    public function getId()
    {
        return $this->id;
    }

    public function setEmail()
    {
        return $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}
