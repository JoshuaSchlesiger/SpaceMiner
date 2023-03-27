<?php

class Job{

    private $number = 0;

    function Job($number){
        $this->$number = $number;
    }

    public function test()
    {
        return $this->number;
    }
}


?>