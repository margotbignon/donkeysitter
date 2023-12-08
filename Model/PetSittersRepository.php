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


    public function insertRow(PetSitters $petSitter, $checkImage, $ageDifference) {
        
         try {
                
                if ($checkImage !== UPLOAD_ERR_OK) {
                    $errorMessages[] = "Erreur lors du téléchargement du fichier.";
                }
                
                if (empty($petSitter->getFirstName()) || (empty($petSitter->getLastName())) || (empty($petSitter->getPhoneNb()))  || (empty($petSitter->getBirthDate())) || (empty($petSitter->getStreet())) || (empty($petSitter->getPostalCode())) || (empty($petSitter->getCity())) || (empty($petSitter->getImage())) || (empty($petSitter->getDescription())) || (empty($petSitter->getPetterSince())) || (empty($petSitter->getResidenceType_id()))){
                    $errorMessages[] = "Veuillez renseigner tous les champs obligatoires.";
                }

                if ((!empty($petSitter->getBirthDate())) && $ageDifference->y < 18) {
                    $errorMessages[] ="Vous devez avoir au moins 18 ans pour vous inscrire.";
                }

                if (!empty($errorMessages)) {
                    throw new Exception (implode("<br><center>", $errorMessages));
                }
                $imageBlob = base64_encode(file_get_contents($petSitter->getImage()));
            if (empty($petSitter->getAnimaltypeId())) {
                $query=<<<SQL
                INSERT INTO 
                    petSitters (lastName, firstName, phoneNb, birthDate, image, description, petSitterSince, residenceType_id, sitterStreet, sitterPostalCode, sitterCity, userid)
                VALUES
                (:lastName, :firstName, :phoneNb, :birthDate, :image, :description, :petSitterSince, :residenceTypeId, :street, :postalCode, :city, :userid)
        SQL;
                $statement = $this->pdo->prepare($query); 
                $statement->bindValue(':firstName', $petSitter->getFirstName(), \PDO::PARAM_STR);
                $statement->bindValue(':lastName', $petSitter->getLastName(), \PDO::PARAM_STR);
                $statement->bindValue(':phoneNb', $petSitter->getPhoneNb(), \PDO::PARAM_STR);
                $statement->bindValue(':birthDate', $petSitter->getBirthDate(), \PDO::PARAM_STR);
                $statement->bindParam(':image', $imageBlob, \PDO::PARAM_LOB);
                $statement->bindValue(':street', $petSitter->getStreet(), \PDO::PARAM_STR);
                $statement->bindValue(':postalCode', $petSitter->getPostalCode(), \PDO::PARAM_STR);
                $statement->bindValue(':city', $petSitter->getCity(), \PDO::PARAM_STR);
                $statement->bindValue(':description', $petSitter->getDescription(), \PDO::PARAM_STR);
                $statement->bindValue(':petSitterSince', $petSitter->getPetterSince(), \PDO::PARAM_STR);
                $statement->bindValue(':residenceTypeId', $petSitter->getResidenceType_id(), \PDO::PARAM_STR);
                $statement->bindValue(':userid', $petSitter->getUserid(), \PDO::PARAM_STR);
                $statement->execute();
            } else {
                $query=<<<SQL
                INSERT INTO 
                    petSitters (lastName, firstName, phoneNb, birthDate, image, description, petSitterSince, residenceType_id, sitterStreet, sitterPostalCode, sitterCity, animalType_id, userid)
                VALUES
                (:lastName, :firstName, :phoneNb, :birthDate, :image, :description, :petSitterSince, :residenceTypeId, :street, :postalCode, :city, :animalTypeId, :userid)
    SQL;
                $statement = $this->pdo->prepare($query); 
                $statement->bindValue(':firstName', $petSitter->getFirstName(), \PDO::PARAM_STR);
                $statement->bindValue(':lastName', $petSitter->getLastName(), \PDO::PARAM_STR);
                $statement->bindValue(':phoneNb', $petSitter->getPhoneNb(), \PDO::PARAM_STR);
                $statement->bindValue(':birthDate', $petSitter->getBirthDate(), \PDO::PARAM_STR);
                $statement->bindParam(':image', $imageBlob, \PDO::PARAM_LOB);
                $statement->bindValue(':street', $petSitter->getStreet(), \PDO::PARAM_STR);
                $statement->bindValue(':postalCode', $petSitter->getPostalCode(), \PDO::PARAM_STR);
                $statement->bindValue(':city', $petSitter->getCity(), \PDO::PARAM_STR);
                $statement->bindValue(':description', $petSitter->getDescription(), \PDO::PARAM_STR);
                $statement->bindValue(':petSitterSince', $petSitter->getPetterSince(), \PDO::PARAM_STR);
                $statement->bindValue(':residenceTypeId', $petSitter->getResidenceType_id(), \PDO::PARAM_STR);
                $statement->bindValue(':animalTypeId', $petSitter->getAnimaltypeId(), \PDO::PARAM_STR);
                $statement->bindValue(':userid', $petSitter->getUserid(), \PDO::PARAM_STR);
                $statement->execute();
            }
            
            $lastInsertId = $this->pdo->lastInsertId();
            return $lastInsertId;
    } catch (Exception $e) {
        echo "<center>Erreur : " . $e->getMessage();
               }
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

    public function insertPetSitterServices($serviceId, $petSitterId, $price) {
        try {
                if (empty($petSitterId)) {
                    $errorMessages[] = "";
                }
                if (empty($petSitterId) && ((empty($serviceId)) || (empty($price)))) {
                    $errorMessages[] = "";
                } else if (empty($serviceId) || (empty($price)))  {
                    $errorMessages[] = "Veuillez renseigner tous les champs obligatoires.";
                }
                if (!empty($errorMessages)) {
                    throw new Exception (implode("<br><center>", $errorMessages));
                }
            $query=<<<SQL
            INSERT INTO 
                petSitterServices
                (service_id, petSitter_id, price)
            VALUES 
                (:serviceId, :petSitterId, :price)
SQL;
            $statement = $this->pdo->prepare($query);
            $statement->bindValue(':serviceId', $serviceId, \PDO::PARAM_STR);
            $statement->bindValue(':petSitterId', $petSitterId, \PDO::PARAM_STR);
            $statement->bindValue(':price', $price, \PDO::PARAM_STR); 
            $statement->execute();
    } catch (Exception $e) {
        echo "<center>" . $e->getMessage();
    }

    }


    public function insertPetSitterAnimalsAccept($animalTypesId, $petSitterId) {
        try {
                if (empty($petSitterId)) {
                    $errorMessages[] = "";
                }
                if (empty($petSitterId) && (empty($animalTypesId))) {
                    $errorMessages[] = "";
                } else if (empty($animalTypesId)) {
                    $errorMessages[] = "Veuillez renseigner tous les champs obligatoires.";
                }
                if (!empty($errorMessages)) {
                    throw new Exception (implode("<br><center>", $errorMessages));
                }
            $query=<<<SQL
            INSERT INTO 
                petSitters_animalTypes
                (animalTypes_id, petSitter_id)
            VALUES 
                (:animalTypesId, :petSitterId)
SQL;
            $statement = $this->pdo->prepare($query);
            $statement->bindValue(':animalTypesId', $animalTypesId, \PDO::PARAM_STR);
            $statement->bindValue(':petSitterId', $petSitterId, \PDO::PARAM_STR);
            $statement->execute();
        } catch (Exception $e) {
        echo "<center>" . $e->getMessage();
    }
    }

}



