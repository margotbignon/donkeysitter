<?php


class Images
{
    private int $id;
    private string $image;

    public function __construct(int $id, string $image)
    {
        $this->id = $id;
        $this->image = $image;
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
        return $this->image;
    }

    /**
     * Set the value of serviceType
     *
     * @return  self
     */ 
    public function setServiceType($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}

?>