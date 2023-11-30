<?php

class AvailRepository {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    public function deleteRow(int $id) : array
    {
        $query = "DELETE * FROM availabilities WHERE idavailability = :id";
        $statement = $this->pdo ->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement ->execute();
        $availability = $statement ->fetch(PDO::FETCH_ASSOC);
        return $availability;
    }


    public function getRow(int $id) : array
    {
        $query = "SELECT * FROM availabilities WHERE idavailability = :id";
        $statement = $this->pdo ->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement ->execute();
        $availability = $statement ->fetch(PDO::FETCH_ASSOC);
        return $availability;

    }

    public function insertRow(Availability $availability): bool
    {
        $query = "INSERT INTO pets (startDate, endDate, maxPetCare,  petSitter_id) 
                  VALUES (:startDate, :endDate, :maxPetCare, :petSitter_id)";
        
        $statement = $this->pdo->prepare($query);
        
        $statement->bindValue(':startDate', $availability->getStartDate(), PDO::PARAM_STR);
        $statement->bindValue(':endDate', $availability->getEndDate(), PDO::PARAM_STR);
        $statement->bindValue(':maxPetCare', $availability->getMaxPetCare(), PDO::PARAM_INT);
        $statement->bindValue(':petSitter_id', $availability->getPetsitterId(), PDO::PARAM_INT);
        
        return $statement->execute();
    }


    public function updateRow(Availability $availability): bool
    {
        $query = "UPDATE availabilities 
                  SET startDate = :startDate, endDate = :endDate, maxPetCare = :maxPetCare, petSitter_id = :petSitter_id
                  WHERE idavailabilty = :id";
        
        $statement = $this->pdo->prepare($query);
        
        $statement->bindValue(':startDate', $availability->getStartDate(), PDO::PARAM_STR);
        $statement->bindValue(':endDate', $availability->getEndDate(), PDO::PARAM_STR);
        $statement->bindValue(':maxPetCare', $availability->getMaxPetCare(), PDO::PARAM_INT);
        $statement->bindValue(':petSitter_id', $availability->getPetsitterId(), PDO::PARAM_INT);
        
        return $statement->execute();
    }


} 