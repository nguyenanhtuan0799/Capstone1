<?php

class Account
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
    public $createDate;

    //connect dbname
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //create
    public function createAccount()
    {
        $query = "INSERT INTO account SET user_name=:user_name,password=:password,role_id=:role_id,createDate=:createDate";
        $stmt = $this->conn->prepare($query);
        //clean
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->role_id = htmlspecialchars(strip_tags($this->role_id));
        $this->createDate = htmlspecialchars(strip_tags($this->createDate));

        //bind data
        $stmt->bindParam(':user_name', $this->user_name);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role_id', $this->role_id);
        $stmt->bindParam(':createDate', $this->createDate);


        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error %.\n ,$stmt->error");
            return false;
        }
    }

    public function resetPassword()
    {
        $query = "UPDATE account SET password=:password WHERE account_id=:account_id";
        $stmt = $this->conn->prepare($query);
        //clean
        $this->password = htmlspecialchars(strip_tags($this->password));

        //bind data
        $stmt->bindParam(':account_id', $this->account_id);
        $stmt->bindParam(':password', $this->password);
        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error %.\n ,$stmt->error");
            return false;
        }
    }
    public function deleteAccount()
    {
        $query = "DELETE FROM account where account_id =:account_id";
        $stmt = $this->conn->prepare($query);
        //clean
        $this->account_id = htmlspecialchars(strip_tags($this->account_id));
        //bind data
        $stmt->bindParam(':account_id', $this->account_id);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error %.\n ,$stmt->error");
            return false;
        }
    }
}
