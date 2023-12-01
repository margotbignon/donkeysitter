<?php

class Pet {
    private int $id = 0;

    private string $name;
    private string $description;
    private string $race;
    private string $gender;
    private string $yearBirth;
    private ?string $masterId = NULL;
    private string $animalTypeId;
    private string $sizeId;


    public function __construct(string $name, string $description, string $race,string $gender, string $yearBirth, string $animalTypeId, string $sizeId, string $masterId = NULL, int $id = 0)
    {

        $this->name = $name;
        $this->description= $description;
        $this->race=$race;
        $this->gender=$gender;
        $this->yearBirth=$yearBirth;
        $this->animalTypeId =$animalTypeId;
        $this->sizeId =$sizeId;
        $this->masterId=$masterId;
        $this->id = $id;

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
     * Get the value of race
     */ 
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set the value of race
     *
     * @return  self
     */ 
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

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
            return $this;

    }

    /**
     * Get the value of animalTypeId
     */ 
    public function getAnimalTypeId()
    {
        return $this->animalTypeId;
    }

    /**
     * Set the value of animalTypeId
     *
     * @return  self
     */ 
    public function setAnimalTypeId($animalTypeId)
    {
        $this->animalTypeId = $animalTypeId;

        return $this;
    }

    /**
     * Get the value of sizeId
     */ 
    public function getSizeId()
    {
        return $this->sizeId;
    }

    /**
     * Set the value of sizeId
     *
     * @return  self
     */ 
    public function setSizeId($sizeId)
    {
        $this->sizeId = $sizeId;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of yearBirth
     */ 
    public function getYearBirth()
    {
        return $this->yearBirth;
    }

    /**
     * Set the value of yearBirth
     *
     * @return  self
     */ 
    public function setYearBirth($yearBirth)
    {
        $this->yearBirth = $yearBirth;

        return $this;
    }
}

?>
