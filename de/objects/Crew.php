<?php

require "Job.php";

class Crew{

    private $name = "";
    private $seller = "";
    private $paid_in_status = false;

    function crew($name){
        $this->$name = $name;
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

    public function getPaidInStatis(){
        return  $this->paid_in_status;
    }

    public function test()
    {
        $test = new Job("10");
        return $test->test();
    }
}


?>