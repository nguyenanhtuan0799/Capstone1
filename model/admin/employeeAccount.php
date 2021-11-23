<?php

class EmployeeAccount
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
    public $password;

    //connect dbname
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //read
    public function viewAccount()
    {
        $query = "SELECT * FROM account WHERE role_id = 2";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //create
    public function createAccount()
    {
        $query = "INSERT INTO account SET user_name=:user_name,password=:password";
        $stmt = $this->conn->prepare($query);
        //clean
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->password = htmlspecialchars(strip_tags($this->password));
        //bind data
        $stmt->bindParam(':user_name', $this->user_name);
        $stmt->bindParam(':password', $this->password);
        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error %.\n .$stmt->error");
            return false;
        }
    }
}
