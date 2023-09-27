<?php

class UserModel
{
    private $user;
    
    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}