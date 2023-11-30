<?php

class ResidenceTypes
{
    private int $id;
    private string $residenceType;

    public function __construct(int $id, string $residenceType)
    {
        $this->id = $id;
        $this->residenceType = $residenceType;
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
     * Get the value of residenceType
     */ 
    public function getResidenceType()
    {
        return $this->residenceType;
    }

    /**
     * Set the value of residenceType
     *
     * @return  self
     */ 
    public function setResidenceType($residenceType)
    {
        $this->residenceType = $residenceType;

        return $this;
    }
}


?>