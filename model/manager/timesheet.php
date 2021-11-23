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
    public $shift_time;

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
}
