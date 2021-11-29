<?php

class Timesheet
{
    private $conn;
    public $account_id;
    public $fullname;
    public $date;
    public $start_time;
    public $hours;
    public $overtime;
    public $dayofweek;
    public $late_arrival;
    public $status;
    public $shift_name;
    public $avatar;
    public $email;
    public $phone_number;
    public $address;
    public $headquerter;
    public $role_id;

    //connect dbname
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //editProfile
    public function timesheet()
    {
        // $query = "electronic_signature=:electronic_signature WHERE account_id=:account_id";
        $query = "SELECT account.fullname,timesheet.* FROM account,timesheet where account.account_id = timesheet.account_id ORDER BY account_id,date ASC, hours DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function infoTimesheet()
    {
        // $query = "electronic_signature=:electronic_signature WHERE account_id=:account_id";
        $query = "SELECT account.fullname,timesheet.* FROM account,timesheet where timesheet.account_id =? AND account.account_id = timesheet.account_id  ORDER BY hours DESC,shift_time ASC ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->account_id);
        $stmt->execute();
        return $stmt;
    }
     public function viewReport()
    {
        // $query = "electronic_signature=:electronic_signature WHERE account_id=:account_id";
        $query = "SELECT account.fullname,account.avatar,account.email,account.phone_number,account.address,account.headquerter,account.role_id,timesheet.* FROM account,timesheet where account.fullname like :fullname and account.account_id=timesheet.account_id AND account.role_id = 2 ORDER BY hours DESC,shift_time ASC ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fullname",$this->fullname);
        $stmt->execute();
        return $stmt;
    }
}
