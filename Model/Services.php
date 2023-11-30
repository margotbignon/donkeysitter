<?php


class Services
{
    private int $id;
    private string $serviceType;

    public function __construct(int $id, string $serviceType)
    {
        $this->id = $id;
        $this->serviceType = $serviceType;
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
     * Get the value of serviceType
     */ 
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * Set the value of serviceType
     *
     * @return  self
     */ 
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;

        return $this;
    }
}

?>