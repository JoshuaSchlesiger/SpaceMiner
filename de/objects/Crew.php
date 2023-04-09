<?php

require "Job.php";

class Crew{

    private $name = "";
    private $id = "";
    private $seller = "";
    private $paid_in_status = false;

    function __construct(String $name, int $id){
        $this->name = $name;
        $this->id = $id;
    }

    public function setSeller($seller){
        $this->seller = $seller;
    }

    public function setPaidInStatus($paid_in_status){
        $this->paid_in_status = $paid_in_status;
    }

    public function getSeller(){
        return  $this->seller;
    }

    public function getPaidInStatus(){
        return  $this->paid_in_status;
    }

    public function getName(){
        return $this->name;
    }

    public function getID(){
        return $this->id;
    }

    public function test($value)
    {
        $test = new Job($value);
        return $test->test();
    }
}


?>