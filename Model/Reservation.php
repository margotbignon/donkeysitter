<?php

class Reservation {

    private int $id;
    private DateTime $startDate;
    private DateTime $endDate;
    private float $totalPrice;
    private string $status;
    private string $description;
    private int $serviceId;
    private int $masterId;
    private int $petSitterId;

    public function __construct(DateTime $startDate,DateTime $endDate,  float $totalPrice, string $status, string $description, int $serviceId , int $masterId, int $petSitterId )
    
    {
        $this-> startDate = $startDate;
        $this-> endDate = $endDate;
        $this-> totalPrice = $totalPrice;
        $this-> status=$status;
        $this-> description=$description;
        $this-> serviceId = $serviceId;
        $this -> masterId = $masterId;
        $this-> petSitterId = $petSitterId;
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of startDate
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */ 
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of endDate
     */ 
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */ 
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of totalPrice
     */ 
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set the value of totalPrice
     *
     * @return  self
     */ 
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of serviceId
     */ 
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Set the value of serviceId
     *
     * @return  self
     */ 
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * Get the value of masterId
     */ 
    public function getMasterId()
    {
        return $this->masterId;
    }

    /**
     * Set the value of masterId
     *
     * @return  self
     */ 
    public function setMasterId($masterId)
    {
        $this->masterId = $masterId;

        return $this;
    }

    /**
     * Get the value of petSitterId
     */ 
    public function getPetSitterId()
    {
        return $this->petSitterId;
    }

    /**
     * Set the value of petSitterId
     *
     * @return  self
     */ 
    public function setPetSitterId($petSitterId)
    {
        $this->petSitterId = $petSitterId;

        return $this;
    }
}