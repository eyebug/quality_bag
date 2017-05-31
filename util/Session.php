<?php

class Session
{

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    const ERROR_EMAIL_USED = 1;
    const ERROR_ERROR_PASSWORD = 2;
    const ERROR_EMAIL_NOT_EXIST = 3;

    private static $_instance;

    private function __construct()
    {
        session_start();
    }

    public static function getSession()
    {
        if (!self::$_instance instanceof Session) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function login($email, $password)
    {
        $result = DB::getDB()->query("SELECT * FROM users WHERE email = ? LIMIT 1", 's', $email);
        if (count($result) == 0) {
            throw new Exception("Username not exist", self::ERROR_EMAIL_NOT_EXIST);
        }
        if (md5($password) == $result[0]['password']) {
            session_destroy();
            session_start();
            foreach($result[0] as $key => $value){
                if($key == "password") continue;
                $_SESSION[$key] = $value;
            }
        } else {
            throw new Exception("Error password", self::ERROR_ERROR_PASSWORD);
        }
    }

    public function logout()
    {
        unset($_SESSION);
        session_destroy();
    }


    public function register($email, $username, $password, $mobileNo, $homephoneNo, $workPhoneNo, $address)
    {
        $result = DB::getDB()->query("SELECT * FROM users WHERE email = ? LIMIT 1", 's', $email);
        if (count($result) > 0) {
            throw new Exception("Email is already used", self::ERROR_EMAIL_USED);
        }
        $password = md5($password);
        DB::getDB()->query("INSERT INTO users(name, email, password, mobile_no, homephone_no, workphone_no, address)
          VALUE (?,?,?,?,?,?,?)
        ", 'sssssss', $username, $email, $password, $mobileNo, $homephoneNo, $workPhoneNo, $address);
    }

}
