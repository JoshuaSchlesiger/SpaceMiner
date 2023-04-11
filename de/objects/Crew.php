<?php

class Crew{

    private $name = "";
    private $jobid = "";
    private $id = "";
    private $seller = "";
    private $paid_in_status = false;

    function __construct(int $jobid ,String $name, int $id){
        $this->name = $name;
        $this->jobid = $jobid;
        $this->id = $id;
    }

    public function setSeller($seller){
        $this->seller = $seller;
    }

    public function getSeller(){
        return  $this->seller;
    }

    public function setPaidInStatus($paid_in_status){
        $this->paid_in_status = $paid_in_status;
    }

    public function getPaidInStatus(){
        return  $this->paid_in_status;
    }

    public function getName(){
        return $this->name;
    }

    public function getJobid(){
        return $this->jobid;
    }

    public function getid(){
        return $this->id;
    }

}


?>