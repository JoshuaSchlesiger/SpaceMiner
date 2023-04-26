<?php

class Task{

    private $id = 0;
    private $duration = 0;
    private $costs = 0;
    private $crewid = 0;
    private $selling_stationid = 0;
    private $refinery_stationid = 0;
    private $mass = [];
    private $typeid = [];
    private $create_time = 0;

    function __construct(int $id, int $duration, int $crewid, int $refinery_stationid, $mass, $typeid, int $costs, int $create_time) {
        $this->id = $id;
        $this->duration = $duration;
        $this->crewid = $crewid;
        $this->refinery_stationid = $refinery_stationid;
        $this->mass = $mass;
        $this->typeid = $typeid;
        $this->costs = $costs;
        $this->create_time = $create_time;
    }

    function getId(): int {
        return $this->id;
    }

    function getDuration(): int {
        return $this->duration;
    }

    function getCrewId(): int {
        return $this->crewid;
    }

    function getRefineryStationId(): int {
        return $this->refinery_stationid;
    }

    function getMass(): int {
        return $this->mass;
    }

    function getTypeId(): int {
        return $this->typeid;
    }

    function getCosts(): int {
        return $this->costs;
    }

    function setSellingStationId(int $selling_stationid){
        $this->selling_stationid = $selling_stationid;
    }

    function getCreateTime(){
        return $this->create_time;
    }

}


?>