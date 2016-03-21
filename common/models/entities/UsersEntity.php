<?php

class UsersEntity extends Entity
{
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $regTime;
    protected $gender;
    protected $permition;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function deletePassword()
    {
        $this->password = null;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRegTime()
    {
        return $this->regTime;
    }

    /**
     * @param mixed $regTime
     */
    public function setRegTime($regTime)
    {
        $this->regTime = $regTime;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getPermition()
    {
        return $this->permition;
    }

    /**
     * @param mixed $permition
     */
    public function setPermition($permition)
    {
        $this->permition = $permition;
    }








}
