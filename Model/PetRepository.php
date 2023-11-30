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

    public function insertRow(Pet $pet): bool
    {
        $query = "INSERT INTO pets (name, image, description, race, gender, masterId, animalTypeId, sizeId) 
                  VALUES (:name, :image, :description, :race, :gender, :masterId, :animalTypeId, :sizeId)";
        
        $statement = $this->pdo->prepare($query);
        
        $statement->bindValue(':name', $pet->getName(), PDO::PARAM_STR);
        $statement->bindValue(':image', $pet->getImage(), PDO::PARAM_STR);
        $statement->bindValue(':description', $pet->getDescription(), PDO::PARAM_STR);
        $statement->bindValue(':race', $pet->getRace(), PDO::PARAM_STR);
        $statement->bindValue(':gender', $pet->getGender(), PDO::PARAM_STR);
        $statement->bindValue(':masterId', $pet->getMasterId(), PDO::PARAM_INT);
        $statement->bindValue(':animalTypeId', $pet->getAnimalTypeId(), PDO::PARAM_INT);
        $statement->bindValue(':sizeId', $pet->getSizeId(), PDO::PARAM_INT);
        
        return $statement->execute();
    }


    public function updateRow(Pet $pet): bool
    {
        $query = "UPDATE pets 
                  SET name = :name, image = :image, description = :description, race = :race, gender = :gender, 
                      masterId = :masterId, animalTypeId = :animalTypeId, sizeId = :sizeId 
                  WHERE idpet = :id";
        
        $statement = $this->pdo->prepare($query);
        
        $statement->bindValue(':id', $pet->getId(), PDO::PARAM_INT);
        $statement->bindValue(':name', $pet->getName(), PDO::PARAM_STR);
        $statement->bindValue(':image', $pet->getImage(), PDO::PARAM_STR);
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