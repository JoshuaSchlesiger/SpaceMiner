<?php

class Job{

    private $number = "";
    private $createTime = 0;
    private $website_user_id = "";
    private $id = "";

    function __construct(int $id,int $number, int $createTime){
        $this->number = $number;
        $this->id = $id;
        $this->createTime = $createTime;
    }

    public function getNumber() {
        return $this->number;
    }

    
    public function getid() {
    return $this->id;
    }
}


?>