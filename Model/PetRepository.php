<?php

class PetRepository {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }


    public function getRow(int $id) : array
    {
        $query = "SELECT * FROM pets WHERE idpet = :id";
        $statement = $this->pdo ->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement ->execute();
        $pet = $statement ->fetch(PDO::FETCH_ASSOC);
        return $pet;
    }


    public function deleteRow(int $id) : array
    {
        $query = "DELETE * FROM pets WHERE idpet = :id";
        $statement = $this->pdo ->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement ->execute();
        $pet = $statement ->fetch(PDO::FETCH_ASSOC);
        return $pet;
    }

    public function insertRow(Pet $pet)
    {
        try {
            if (empty($pet->getMasterId())) {
                $errorMessages[] = "";
            }
            if (empty($pet->getMasterId()) && ((empty($pet->getName())) || (empty($pet->getYearBirth())) || (empty($pet->getYearBirth())) || (empty($pet->getDescription())) || (empty($pet->getRace())) ||(empty($pet->getGender())) || (empty($pet->getAnimalTypeId())) || (empty($pet->getSizeId())) )) {
                $errorMessages[] = "";
            } else {
                if ((empty($pet->getName())) || (empty($pet->getYearBirth())) || (empty($pet->getYearBirth())) || (empty($pet->getDescription())) || (empty($pet->getRace())) ||(empty($pet->getGender())) || (empty($pet->getAnimalTypeId())) || (empty($pet->getSizeId())) ) {
                    $errorMessages[] = "Veuillez renseigner tous les champs obligatoires.";
                }

            }

            if (!empty($errorMessages)) {
                throw new Exception (implode("<br><center>", $errorMessages));
            }
            
            $query = "INSERT INTO pets (name, yearBirth, description, race, gender, master_id, animalType_id, size_id) 
                    VALUES (:name, :yearBirth, :description, :race, :gender, :masterId, :animalTypeId, :sizeId)";
            
            $statement = $this->pdo->prepare($query);
            
            $statement->bindValue(':name', $pet->getName(), PDO::PARAM_STR);
            $statement->bindValue(':yearBirth', $pet->getYearBirth(), PDO::PARAM_STR);
            $statement->bindValue(':description', $pet->getDescription(), PDO::PARAM_STR);
            $statement->bindValue(':race', $pet->getRace(), PDO::PARAM_STR);
            $statement->bindValue(':gender', $pet->getGender(), PDO::PARAM_STR);
            $statement->bindValue(':masterId', $pet->getMasterId(), PDO::PARAM_STR);
            $statement->bindValue(':animalTypeId', $pet->getAnimalTypeId(), PDO::PARAM_INT);
            $statement->bindValue(':sizeId', $pet->getSizeId(), PDO::PARAM_INT);
            
            return $statement->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function updateRow(Pet $pet): bool
    {
        $query = "UPDATE pets 
                  SET name = :name, yearBirth, description = :description, race = :race, gender = :gender, 
                      master_id = :masterId, animalType_id = :animalTypeId, size_id = :sizeId 
                  WHERE idpet = :id";
        
        $statement = $this->pdo->prepare($query);
        
        $statement->bindValue(':id', $pet->getId(), PDO::PARAM_INT);
        $statement->bindValue(':name', $pet->getName(), PDO::PARAM_STR);
        $statement->bindValue(':yearBirth', $pet->getYearBirth(), PDO::PARAM_STR);
        $statement->bindValue(':description', $pet->getDescription(), PDO::PARAM_STR);
        $statement->bindValue(':race', $pet->getRace(), PDO::PARAM_STR);
        $statement->bindValue(':gender', $pet->getGender(), PDO::PARAM_STR);
        $statement->bindValue(':masterId', $pet->getMasterId(), PDO::PARAM_INT);
        $statement->bindValue(':animalTypeId', $pet->getAnimalTypeId(), PDO::PARAM_INT);
        $statement->bindValue(':sizeId', $pet->getSizeId(), PDO::PARAM_INT);
        
        return $statement->execute();
    }

}

?>