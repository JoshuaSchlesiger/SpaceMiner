<?php

class Crew{

    private $cname = "";
    private $jid = "";
    private $cid = "";
    private $seller = "";
    private $paid_in_status = false;

    function __construct(int $jid ,String $cname, int $cid){
        $this->cname = $cname;
        $this->jid = $jid;
        $this->cid = $cid;
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

    public function getCname(){
        return $this->cname;
    }

    public function getJid(){
        return $this->jid;
    }

    public function getCid(){
        return $this->cid;
    }

}


?>