<?php

class Player{

    private $id = "";
    private $name = "";
    private $type = 0;
    private $paid_out_status = false;
    private $crewid = "";

    function __construct(String $name, int $id, int $crewid, int $type){
        $this->name = $name;
        $this->id = $id;
        $this->crewid = $crewid;
        $this->type = $type;
    }


    public function getid() {
        return $this->id;
    }

    public function getname() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function getPaidOutStatus() {
        return $this->paid_out_status;
    }

    public function setPaidOutStatus(bool $paid_out_status) {
       $this->paid_out_status = $paid_out_status;
    }

    public function getCrewid() {
        return $this->id;
    }


}


?>