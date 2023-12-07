<?php 
require_once "Users.php";
class PetSitters extends Users {
   
        private string $description;
        private string $petterSince;
        private int $residenceType_id;
        protected int $userId; 
        protected int $animaltypeId;
    
        public function __construct(
            int $petSitterId, 
            string $firstName, 
            string $lastName, 
            string $phoneNb, 
            string $birthDate, 
            string $image, 
            string $street, 
            string $PostalCode, 
            string $City,
            string $description, 
            string $petterSince, 
            int $residenceType_id, 
            int $animaltypeId, 
            int $userId
        ) {
            parent::__construct($petSitterId, $firstName, $lastName, $phoneNb, $birthDate, $image, $street, $PostalCode, $City, $userId);
            $this->description = $description;
            $this->petterSince = $petterSince;
            $this->residenceType_id = $residenceType_id;
            $this->userId = $userId;
            $this->animaltypeId=$animaltypeId;
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