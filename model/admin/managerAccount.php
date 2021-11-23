<?php

class ManagerAccount
{
    private $conn;
    public $account_id;
    public $avatar;
    public $user_name;
    public $role_id;
    public $fullname;
    public $phone_number;
    public $address;
    public $email;

    //connect dbname
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //read
    public function viewAccount()
    {
        $query = "SELECT * FROM account WHERE role_id = 1";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
