<?php
/**
 * Created by PhpStorm.
 * User: apramodya
 * Date: 8/14/17
 * Time: 8:41 PM
 */

class Database{
    public $host = DB_HOST, $username = DB_USER, $password = DB_PASS, $db_name = DB_NAME;

    public $link, $error;

    public function __construct(){
         $this->connect();
    }

    // connection
    private function connect(){
        $this->link = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if(!$this->link){
            $this->error = "Connection Failed ".$this->link->connect_error;
            return false;
        }
    }

    // select
    public function select($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if ($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }
    }

    // insert
    public function insert($query){
        $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);

        if ($insert_row){
            header("Location: index.php?msg=".urlencode("Record Added"));
            exit();
        }
        else{
            die("Error: ".$this->link->error );
        }
    }

    // update
    public function update($query){
        $update_row = $this->link->query($query) or die($this->link->error.__LINE__);

        if ($update_row){
            header("Location: index.php?msg=".urlencode("Record Updated"));
            exit();
        }
        else{
            die("Error: ".$this->link->error );
        }
    }

    // delete
    public function delete($query){
        $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);

        if ($delete_row){
            header("Location: index.php?msg=".urlencode("Record Deleted"));
        }
        else{
            die("Error: ".$this->link->error );
        }
    }
}