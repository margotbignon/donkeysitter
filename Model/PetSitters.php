<?php 
require_once "Users.php";
class PetSitters extends Users {
   

    public function __construct(
        int $id, string $firstName, string $lastName, string $phoneNb, string $email, string $passWord, string $birthDate, string $image, string $street, string $PostalCode, string $City,
        private string $description, 
        private string $petterSince, 
        private int $residenceType_id,
        
        ) {
            parent::__construct($id, $firstName, $lastName, $phoneNb, $email, $passWord, $birthDate, $image, $street, $PostalCode, $City);
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
}