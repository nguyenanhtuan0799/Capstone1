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
    public $headquerter;
    public $electronic_signature;

    //connect dbname
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //read
    public function viewInfo()
    {
        $query = "SELECT * FROM account WHERE account_id=? LIMIT 1";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->account_id);
        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->avatar = $row['avatar'];
        $this->user_name = $row['user_name'];
        $this->role_id = $row['role_id'];
        $this->fullname = $row['fullname'];
        $this->phone_number = $row['phone_number'];
        $this->address = $row['address'];
        $this->email = $row['email'];
        $this->headquerter = $row['headquerter'];
        $this->electronic_signature = $row['electronic_signature'];
    }
    //editProfile
    public function editProfile()
    {
        $query = "UPDATE account SET avatar=:avatar,fullname=:fullname,phone_number=:phone_number,address=:address,email=:email,headquerter=:headquerter,electronic_signature=:electronic_signature WHERE account_id=:account_id";
        $stmt = $this->conn->prepare($query);
        //clean
        $this->avatar = htmlspecialchars(strip_tags($this->avatar));
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->headquerter = htmlspecialchars(strip_tags($this->headquerter));
        $this->electronic_signature = htmlspecialchars(strip_tags($this->electronic_signature));
        //bind data
        $stmt->bindParam(':account_id', $this->account_id);
        $stmt->bindParam(':avatar', $this->avatar);
        $stmt->bindParam(':fullname', $this->fullname);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':headquerter', $this->headquerter);
        $stmt->bindParam(':electronic_signature', $this->electronic_signature);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error %.\n ,$stmt->error");
            return false;
        }
    }
}
