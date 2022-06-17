<?php

namespace App\Models;

use PDO;


/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public $errors = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, name FROM member');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $this->validate();
        if (empty($this->errors)) {
            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            //echo $password_hash;
            $sql = 'INSERT INTO member (name,phone,gmail,password) VALUES ( :name, :phone, :email, :password_hash)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }
    public function validate()
    {
        if ($this->name == '') {
            $this->errors[] = 'Name is required';
        }
        if ($this->phoneExists($this->phone)) {
            $this->errors[] = 'Phone number already taken';
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) == false) {
            $this->errors[] = 'Invalid email';
        }
        if ($this->emailExists($this->email)) {
            $this->errors[] = 'email already taken';
        }
        if ($this->password != $this->password_confirmation) {
            $this->errors[] = 'Passwordd must match';
        }
        if (strlen($this->phone) > 10 || strlen($this->phone) < 10) {
            $this->errors[] = 'Please enter 10 digit phone number';
        }
        if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
            $this->errors[] = 'Atleast one letter for password';
        }
        if (preg_match('/.*\d+.*/i', $this->password) == 0) {
            $this->errors[] = 'Atleast one number for password';
        }
    }


    public static function emailExists($email)
    {
        return static::findByEmail($email) !== false;
    }

    public static function phoneExists($phone)
    {
        return static::findByPhone($phone) !== false;
    }

    public static function authenticate($email, $password)
    {
        $user = static::findByEmail($email);

        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }

        return false;
    }


    public static function findByEmail($email)
    {
        $sql = 'SELECT * FROM member WHERE gmail = :email';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }


    public static function findByPhone($phone)
    {
        $sql = 'SELECT * FROM member WHERE phone = :phone';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }



    public static function findByID($id)
    {
        $sql = 'SELECT * FROM member WHERE mem_id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }
}
