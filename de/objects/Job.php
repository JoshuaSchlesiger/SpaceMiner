<?php

class Job{

    private $number = "";
    private $website_user_id = "";
    private $jid = "";

    function __construct(int $jid,int $number){
        $this->number = $number;
        $this->jid = $jid;
    }

    public function getNumber() {
        return $this->number;
    }

    
    public function getJid() {
    return $this->jid;
    }
}


?>