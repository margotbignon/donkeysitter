<?php

class  Availability {
    private int $id;
    private DateTime $startDate;
    private DateTime $endDate;
    private int $maxPetCare;
    private int $petsitterId;


    public function __construct(int $id, DateTime $startDate, DateTime $endDate, int $maxPetCare, int $petsitterId)
    {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->maxPetCare = $maxPetCare;
        $this->petsitterId=$petsitterId;
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
     * Get the value of maxPetCare
     */ 
    public function getMaxPetCare()
    {
        return $this->maxPetCare;
    }

    /**
     * Set the value of maxPetCare
     *
     * @return  self
     */ 
    public function setMaxPetCare($maxPetCare)
    {
        $this->maxPetCare = $maxPetCare;

        return $this;
    }

    /**
     * Get the value of petsitterId
     */ 
    public function getPetsitterId()
    {
        return $this->petsitterId;
    }

    /**
     * Set the value of petsitterId
     *
     * @return  self
     */ 
    public function setPetsitterId($petsitterId)
    {
        $this->petsitterId = $petsitterId;

        return $this;
    }

    //
}