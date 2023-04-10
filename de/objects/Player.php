<?php

class Player{

    private $pid = "";
    private $pname = "";
    private $type = 0;
    private $paid_out_status = false;
    private $cid = "";

    function __construct(String $pname, int $pid, int $cid, int $type){
        $this->pname = $pname;
        $this->pid = $pid;
        $this->cid = $cid;
        $this->type = $type;
    }


    public function getPid() {
        return $this->pid;
    }

    public function getPname() {
        return $this->pname;
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

    public function getCid() {
        return $this->cid;
    }


}


?>