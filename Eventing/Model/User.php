<?php

namespace Eventing\Model;

use ArrayObject;

class User
{
    private $id;
    private $username;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $passwordEncrypted;
    private $remember_token;
    private $created_at;
    private $updated_at;
    private $roles;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($remember_token)
    {
        $this->remember_token = $remember_token;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles(ArrayObject $roles)
    {
        $this->roles = $roles;
    }

    public function getPasswordEncrypted()
    {
        return $this->passwordEncrypted;
    }

    public function setPasswordEncrypted($passwordEncrypted)
    {
        $this->passwordEncrypted = $passwordEncrypted;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

}