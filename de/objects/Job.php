<?php

class Job{

    private $number = "";

    function __construct($number){
        $this->number = $number;
    }

    public function test()
    {
        return $this->number;
    }
}


?>