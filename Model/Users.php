<?php 
abstract class Users {
    public function __construct(
        protected int $id,
        protected string $firstName, 
        protected string $lastName, 
        protected string $phoneNb,
        protected string $email, 
        protected string $passWord, 
        protected string $birthDate, 
        protected string $image,
        protected string $street, 
        protected string $PostalCode,
        protected string $City
        ) {

        }
    


        public function getId() : int
        {
                return $this->id;
        }


        public function setId($id) : self
        {
                $this->id = $id;

                return $this;
        }


        public function getFirstName() : string
        {
                return $this->firstName;
        }

        public function setFirstName($firstName) : self
        {
                $this->firstName = $firstName;

                return $this;
        }

        public function getLastName() : string
        {
                return $this->lastName;
        }


        public function setLastName($lastName) : self
        {
                $this->lastName = $lastName;

                return $this;
        }

        public function getPhoneNb() : string
        {
                return $this->phoneNb;
        }

        public function setPhoneNb($phoneNb) : self
        {
                $this->phoneNb = $phoneNb;

                return $this;
        }


        public function getEmail() : string
        {
                return $this->email;
        }

        public function setEmail($email) : self
        {
                $this->email = $email;

                return $this;
        }

        public function getPassWord() : string
        {
                return $this->passWord;
        }

        public function setPassWord($passWord) : self
        {
                $this->passWord = $passWord;

                return $this;
        }

        public function getBirthDate() : string
        {
                return $this->birthDate;
        }

        public function setBirthDate($birthDate) : self
        {
                $this->birthDate = $birthDate;

                return $this;
        }


        public function getImage() : string
        {
                return $this->image;
        }

        public function setImage($image) : self
        {
                $this->image = $image;

                return $this;
        }

        public function getStreet() : string
        {
                return $this->street;
        }

        public function setStreet($street) : self
        {
                $this->street = $street;

                return $this;
        }

        public function getPostalCode() : string
        {
                return $this->PostalCode;
        }

        public function setPostalCode($PostalCode) : self
        {
                $this->PostalCode = $PostalCode;

                return $this;
        }


        public function getCity() : string
        {
                return $this->City;
        }


        public function setCity($City) : self
        {
                $this->City = $City;

                return $this;
        }
        
}