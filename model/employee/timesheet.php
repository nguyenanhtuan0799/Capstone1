<?php

class Timesheet
{
    private $conn;
    public $account_id;
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
    public function CreateTimesheet()
    {

        $query = "INSERT INTO timesheet SET account_id=:account_id,date=:date,start_time=:start_time
        ,hours=:hours,overtime=:overtime,dayofweek=:dayofweek,late_arrival=:late_arrival,status=:status
        ,shift_name=:shift_name,shift_time=:shift_time";
        $stmt = $this->conn->prepare($query);
        $this->account_id = htmlspecialchars(strip_tags($this->account_id));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->start_time = htmlspecialchars(strip_tags($this->start_time));
        $this->hours = htmlspecialchars(strip_tags($this->hours));
        $this->overtime = htmlspecialchars(strip_tags($this->overtime));
        $this->dayofweek = htmlspecialchars(strip_tags($this->dayofweek));
        $this->late_arrival = htmlspecialchars(strip_tags($this->late_arrival));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->shift_name = htmlspecialchars(strip_tags($this->shift_name));
        $this->shift_time = htmlspecialchars(strip_tags($this->shift_time));

        $stmt->bindParam(':account_id', $this->account_id);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':start_time', $this->start_time);
        $stmt->bindParam(':hours', $this->hours);
        $stmt->bindParam(':overtime', $this->overtime);
        $stmt->bindParam(':dayofweek', $this->dayofweek);
        $stmt->bindParam(':late_arrival', $this->late_arrival);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':shift_name', $this->shift_name);
        $stmt->bindParam(':shift_time', $this->shift_time);
         if ($stmt->execute()) {
            return true;
        } else {
            printf("Error %.\n .$stmt->error");
            return false;
        }
    }

    public function viewHistory() {
        $query = "SELECT * FROM timesheet where account_id=? ORDER by ts_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->account_id);
        $stmt->execute();

        return $stmt;
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $this->date = $row['date'];
        // $this->shift_name = $row['shift_name'];
        // $this->shift_time = $row['shift_time'];
        // $this->hours = $row['hours'];
        // $this->overtime = $row['overtime'];
        // $this->late_arrival = $row['late_arrival'];
        // $this->status = $row['status'];

    }
   
}
