<?php 
require_once "UsersRepository.php";
class MasterRepository extends UsersRepository {
    private $pdo;
    public function __construct() {
        $this->pdo=Database::getPdo();
    }

    public function getRow(int $id) : array {
        $query = "SELECT * FROM petSitters WHERE idpetSitter= :myId"; 
        $query=<<<SQL
        SELECT
        FROM 
            petSitters ps
        LEFT JOIN
            petSitterServices pss
        ON  
            ps.idpetSitter = pss.idpetSitter
        LEFT JOIN
            services s 
        ON
            pss.service_id = s.idservice
        LEFT JOIN
            residencesTypes rt
        ON 
            ps.residenceType_id = rt.idresidenceType
        GROUP BY 
            ps.idpetSitter
        HAVING
            ps.idpetSitter = :myId; 
              
SQL;
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':myId', $id, \PDO::PARAM_INT); 
        $statement->execute();
        $petSitter = $statement->fetch(PDO::FETCH_ASSOC);
        return $petSitter;
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



