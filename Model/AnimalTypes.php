<?php

class AnimalTypes
{
    private int $id;
    private string $animalType;

    public function __construct(int $id, string $animalType)
    {
        $this->id = $id;
        $this->animalType = $animalType;
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
     * Get the value of animalType
     */ 
    public function getAnimalType()
    {
        return $this->animalType;
    }

    /**
     * Set the value of animalType
     *
     * @return  self
     */ 
    public function setAnimalType($animalType)
    {
        $this->animalType = $animalType;

        return $this;
    }
}


?>