<?php 
require_once "Users.php";
class PetSitters extends Users {
   


    public function __construct(
        string $firstName, string $lastName, string $phoneNb, string $birthDate, string $street, string $PostalCode, string $City, string $userId,  
        private string $description, 
        private string $petterSince, 
        private string $residenceType_id, 
        private string $animalTypeId,
        string $image,
        int $id = 0
        ) {
            parent::__construct($firstName, $lastName, $phoneNb, $birthDate, $street, $PostalCode, $City, $userId, $image, $id);

        }

        public function getResidenceType_id() : int
        {
                return $this->residenceType_id;
        }

        public function setResidenceType_id($residenceType_id) : self
        {
                $this->residenceType_id = $residenceType_id;

                return $this;
        }

        public function getPetterSince() : string
        {
                return $this->petterSince;
        }

 
        public function setPetterSince($petterSince) : self
        {
                $this->petterSince = $petterSince;

                return $this;
        }


        public function getDescription() : string
        {
                return $this->description;
        }

        public function setDescription($description) : self
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of userId
         */ 
        public function getUserId()
        {
                return $this->userId;
        }

        /**
         * Set the value of userId
         *
         * @return  self
         */ 
        public function setUserId($userId)
        {
                $this->userId = $userId;

                return $this;
        }

        /**
         * Get the value of animaltypeId
         */ 
        public function getAnimaltypeId()
        {
                return $this->animaltypeId;
        }

        /**
         * Set the value of animaltypeId
         *
         * @return  self
         */ 
        public function setAnimaltypeId($animaltypeId)
        {
                $this->animaltypeId = $animaltypeId;

                return $this;
        }
}