<?php 
require_once "UsersRepository.php";

class PetsittersRepository extends UsersRepository {
    private $pdo;
    public function __construct() {
        $this->pdo=Database::getPdo();
    }

        public function getRow($id)  {
        $query = "SELECT 
        ps.*, pss.*, s.*, rt.*, a.*, av.*, u.*
    FROM 
        petSitters ps
    LEFT JOIN 
        petSitterServices pss ON ps.idpetSitter = pss.petSitter_id
    LEFT JOIN 
        services s ON pss.service_id = s.idservice
    LEFT JOIN 
        residenceTypes rt ON ps.residenceType_id = rt.idresidenceType
    LEFT JOIN 
        animalTypes a ON ps.animalType_id = a.idanimalType
    LEFT JOIN 
        availabilities av ON ps.idpetSitter = av.petSitter_id
    LEFT JOIN users u ON ps.userid = u.iduser
    WHERE 
        ps.idpetSitter = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT); 
        $statement->execute();
        $petSitter = $statement->fetch(PDO::FETCH_ASSOC);
        $petSitter = new PetSitters(
        $petSitter['idpetSitter'],
        $petSitter['firstName'],
        $petSitter['lastName'],
        $petSitter['phoneNb'],
        $petSitter['birthDate'],
        $petSitter['image'],
        $petSitter['sitterStreet'],
        $petSitter['sitterPostalCode'],
        $petSitter['sitterCity'],
        $petSitter['description'],
        $petSitter['petSitterSince'],
        $petSitter['residenceType_id'],
        $petSitter['animalType_id'],
        $petSitter['userid']
    );
        return $petSitter;
    }




    public function countFrom($table)
    {
        $query = "SELECT count(*) from $table";
        $statement = $this->pdo->query($query);
        $count = $statement->fetchColumn();
        return $count;
    }

    public function getRowsByPost($startDate, $endDate, $city, $serviceId) {
    
        $query = "SELECT 
        ps.*, pss.*, s.*, rt.*, a.*, av.*
    FROM 
        petSitters ps
    LEFT JOIN 
        petSitterServices pss ON ps.idpetSitter = pss.petSitter_id
    LEFT JOIN 
        services s ON pss.service_id = s.idservice
    LEFT JOIN 
        residenceTypes rt ON ps.residenceType_id = rt.idresidenceType
    LEFT JOIN 
        animalTypes a ON ps.animalType_id = a.idanimalType
    LEFT JOIN 
        availabilities av ON ps.idpetSitter = av.petSitter_id
           WHERE 
            (ps.sitterCity = :city OR ps.sitterPostalCode = :city)
            AND pss.service_id = :serviceId
            AND av.startDate <= :startDate AND av.endDate >= :endDate";
    $statement = $this->pdo->prepare($query);
    $statement->bindValue(':city', $city, \PDO::PARAM_STR);
    $statement->bindValue(':serviceId', $serviceId, \PDO::PARAM_STR);
    $statement->bindValue(':startDate', $startDate, \PDO::PARAM_STR);
    $statement->bindValue(':endDate', $endDate, \PDO::PARAM_STR);

    $statement->execute();
    $petsitters = $statement->fetchAll(\PDO::FETCH_ASSOC);
    return $petsitters;
   }
    






    public function getRowsByCity($city) 
    {
        $query = "SELECT 
                ps.*, pss.*, s.*, rt.*, a.*, av.*
            FROM 
                petSitters ps
            LEFT JOIN 
                petSitterServices pss ON ps.idpetSitter = pss.petSitter_id
            LEFT JOIN 
                services s ON pss.service_id = s.idservice
            LEFT JOIN 
                residenceTypes rt ON ps.residenceType_id = rt.idresidenceType
            LEFT JOIN 
                animalTypes a ON ps.animalType_id = a.idanimalType
            LEFT JOIN 
                availabilities av ON ps.idpetSitter = av.petSitter_id
            WHERE 
                ps.sitterCity = :city OR ps.sitterPostalCode = :postalCode";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':city', $city, \PDO::PARAM_STR);
        $statement->bindValue(':postalCode', $city, \PDO::PARAM_STR);
        $statement->execute();
        $petsitters = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $petsitters;
    }
    


    
    public function insertRow(string $firstName, string $lastName, string $phoneNb, string $email, string $passWord, string $birthDate, string $image, string $street, string $postalCode, string $city, string $description, string $petterSince, string $residenceTypeId) {
        $query=<<<SQL
        INSERT INTO 
            petSitters (lastName, firstName, phoneNb, email, password, birthDate, image, description, petSitterSince, residenceType_id, sitterStreet, sitterPostalCode, sitterCity)
        VALUES
        (:lastName, :firstName, :phoneNb, :email, :passWord, :birthDate, :image, :description, :petSitterSince, :residenceTypeId, :street, :postalCode, :city)
SQL;
    $statement = $this->pdo->prepare($query); 
    $statement->bindValue(':firstName', $firstName, \PDO::PARAM_STR);
    $statement->bindValue(':lastName', $lastName, \PDO::PARAM_STR);
    $statement->bindValue(':phoneNb', $phoneNb, \PDO::PARAM_STR);
    $statement->bindValue(':email', $email, \PDO::PARAM_STR);
    $statement->bindValue('passWord', $passWord, \PDO::PARAM_STR);
    $statement->bindValue('birthDate', $birthDate, \PDO::PARAM_STR);
    $statement->bindValue('image', $image, \PDO::PARAM_STR);
    $statement->bindValue('street', $street, \PDO::PARAM_STR);
    $statement->bindValue('postalCode', $postalCode, \PDO::PARAM_STR);
    $statement->bindValue('city', $city, \PDO::PARAM_STR);
    $statement->bindValue('description', $description, \PDO::PARAM_STR);
    $statement->bindValue('petterSince', $petterSince, \PDO::PARAM_STR);
    $statement->bindValue('residenceTypeId', $residenceTypeId, \PDO::PARAM_STR);
    $statement->execute();
    }

public function updateRow(string $firstName, string $lastName, string $phoneNb, string $email, string $passWord, string $birthDate, string $image, string $street, string $postalCode, string $city, string $description, string $petterSince, string $residenceTypeId, int $id) {
    $query=<<<SQL
    UPDATE
        petSitters 
    SET
    lastName = :lastName, firstName = :firstName, phoneNb = :phoneNb, email = :email, password : :passWord, birthDate = :birthDate, image = :image, description = :description, petSitterSince = :petSitterSince, esidenceType_id = :residenceTypeId,  sitterStreet = :street, sitterPostalCode = :postalCode, sitterCity = :city
    WHERE idPetSitter = :myId
SQL;
    $statement = $this->pdo->prepare($query); 
    $statement->bindValue(':firstName', $firstName, \PDO::PARAM_STR);
    $statement->bindValue(':lastName', $lastName, \PDO::PARAM_STR);
    $statement->bindValue(':phoneNb', $phoneNb, \PDO::PARAM_STR);
    $statement->bindValue(':email', $email, \PDO::PARAM_STR);
    $statement->bindValue('passWord', $passWord, \PDO::PARAM_STR);
    $statement->bindValue('birthDate', $birthDate, \PDO::PARAM_STR);
    $statement->bindValue('image', $image, \PDO::PARAM_STR);
    $statement->bindValue('street', $street, \PDO::PARAM_STR);
    $statement->bindValue('postalCode', $postalCode, \PDO::PARAM_STR);
    $statement->bindValue('city', $city, \PDO::PARAM_STR);
    $statement->bindValue('description', $description, \PDO::PARAM_STR);
    $statement->bindValue('petterSince', $petterSince, \PDO::PARAM_STR);
    $statement->bindValue('residenceTypeId', $residenceTypeId, \PDO::PARAM_STR);
    $statement->bindValue('myId', $id, \PDO::PARAM_STR);
    $statement->execute();
    }


}



