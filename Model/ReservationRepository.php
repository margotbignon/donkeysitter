<?php

class ReservationRepository {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    public function getRow(int $id) : array
    {
        $query = "SELECT * FROM reservations WHERE idreservation = :id";
        $statement = $this->pdo ->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement ->execute();
        $reservation = $statement ->fetch(PDO::FETCH_ASSOC);
        return $reservation;

    }

    public function getRowBeforeNow(int $masterId, $idcolumn) : array {
    $query=<<<SQL
        SELECT 
            r.*, p.firstname as FirstNamePetSitter, p.idpetSitter, m.idmaster, m.firstname as FirstNameMaster, s.serviceType, p.image as petSitterImage, m.image as masterImage
        FROM 
            donkeysitter.reservations r
        LEFT JOIN 
            donkeySitter.petsitters p ON r.petSitter_id = p.idpetSitter
        LEFT JOIN 
            donkeySitter.masters m ON r.master_id = m.idmaster
        LEFT JOIN 
            donkeySitter.services s ON r.service_id = s. idservice
        WHERE 
            $idcolumn = :masterId AND startDate < NOW();
SQL;
    $statement = $this->pdo->prepare($query); 
    $statement->bindValue(':masterId', $masterId, PDO::PARAM_INT);
    $statement->execute();
    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $reservations;

    }

    public function getRowAfterNow(int $masterId, $idcolumn) : array {
        $query=<<<SQL
        SELECT 
            r.*, p.firstname as FirstNamePetSitter, p.idpetSitter, m.idmaster, m.firstname as FirstNameMaster, s.serviceType, p.image as petSitterImage, m.image as masterImage
        FROM 
            donkeysitter.reservations r
        LEFT JOIN 
            donkeySitter.petsitters p ON r.petSitter_id = p.idpetSitter
        LEFT JOIN 
            donkeySitter.masters m ON r.master_id = m.idmaster
        LEFT JOIN 
            donkeySitter.services s ON r.service_id = s. idservice
        WHERE 
            $idcolumn = :masterId AND startDate > NOW();
SQL;
        $statement = $this->pdo->prepare($query); 
        $statement->bindValue(':masterId', $masterId, PDO::PARAM_INT);
        $statement->execute();
        $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    
        }


    public function getRowAfterNowStandBy($petSitterId) {
        $query=<<<SQL
        SELECT 
            r.*, p.firstname as FirstNamePetSitter, p.idpetSitter, m.idmaster, m.firstname as FirstNameMaster, s.serviceType, p.image as petSitterImage, m.image as masterImage
        FROM 
            donkeysitter.reservations r
        LEFT JOIN 
            donkeySitter.petsitters p ON r.petSitter_id = p.idpetSitter
        LEFT JOIN 
            donkeySitter.masters m ON r.master_id = m.idmaster
        LEFT JOIN 
            donkeySitter.services s ON r.service_id = s. idservice
        WHERE 
            petSitter_id = :petSitterId AND startDate > NOW() AND status = 'En attente';
SQL;
        $statement = $this->pdo->prepare($query); 
        $statement->bindValue(':petSitterId', $petSitterId, PDO::PARAM_INT);
        $statement->execute();
        $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }

    public function getRowAfterNowConfirmed($petSitterId) {
        $query=<<<SQL
        SELECT 
            r.*, p.firstname as FirstNamePetSitter, p.idpetSitter, m.idmaster, m.firstname as FirstNameMaster, s.serviceType, p.image as petSitterImage, m.image as masterImage
        FROM 
            donkeysitter.reservations r
        LEFT JOIN 
            donkeySitter.petsitters p ON r.petSitter_id = p.idpetSitter
        LEFT JOIN 
            donkeySitter.masters m ON r.master_id = m.idmaster
        LEFT JOIN 
            donkeySitter.services s ON r.service_id = s. idservice
        WHERE 
            petSitter_id = :petSitterId AND startDate > NOW() AND status = 'Validée';
SQL;
        $statement = $this->pdo->prepare($query); 
        $statement->bindValue(':petSitterId', $petSitterId, PDO::PARAM_INT);
        $statement->execute();
        $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }

    public function deleteRow(int $id) : array
    {
        $query = "DELETE * FROM reservations WHERE idreservation = :id";
        $statement = $this->pdo ->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement ->execute();
        $reservation = $statement ->fetch(PDO::FETCH_ASSOC);
        return $reservation;

    }



    public function insertRow(Reservation $reservation): bool
    {
        $query = "INSERT INTO reservations (startDate, endDate, totalPrice, status, description, service_id, master_id,petSitter_id) 
                  VALUES (:startDate, :endDate, :totalPrice, :status, :description, :service_id, :master_id, :petSitter_id)";
        
        $statement = $this->pdo->prepare($query);
        
        $statement->bindValue(':startDate', $reservation->getStartDate(), PDO::PARAM_STR);
        $statement->bindValue(':endDate', $reservation->getEndDate(), PDO::PARAM_STR);
        $statement->bindValue(':totalPrice', $reservation->getTotalPrice(), PDO::PARAM_STR);
        $statement->bindValue(':status', $reservation->getStatus(), PDO::PARAM_STR);
        $statement->bindValue(':description', $reservation->getDescription(), PDO::PARAM_STR);
        $statement->bindValue(':service_id', $reservation->getServiceId(), PDO::PARAM_INT);
        $statement->bindValue(':master_id', $reservation->getMasterId(), PDO::PARAM_INT);
        $statement->bindValue(':petSitter_id', $reservation->getPetSitterId(), PDO::PARAM_INT);
        
        return $statement->execute();
    }

    public function updateRow(Reservation $reservation): bool
    {
        $query = "UPDATE reservations 
                  SET startDate = :startDate, endDate = :endDate, totalPrice = :totalPrice, status = :status, description = :description, service_id = :service_id, master_id = :master_id,petSitter_id = :petSitter_id 
                  WHERE idreservation = :id";
        
        $statement = $this->pdo->prepare($query);
        
        $statement->bindValue(':startDate', $reservation->getStartDate(), PDO::PARAM_STR);
        $statement->bindValue(':endDate', $reservation->getEndDate(), PDO::PARAM_STR);
        $statement->bindValue(':totalPrice', $reservation->getTotalPrice(), PDO::PARAM_STR);
        $statement->bindValue(':status', $reservation->getStatus(), PDO::PARAM_STR);
        $statement->bindValue(':description', $reservation->getDescription(), PDO::PARAM_STR);
        $statement->bindValue(':service_id', $reservation->getServiceId(), PDO::PARAM_INT);
        $statement->bindValue(':master_id', $reservation->getMasterId(), PDO::PARAM_INT);
        $statement->bindValue(':petSitter_id', $reservation->getPetSitterId(), PDO::PARAM_INT);
        
        return $statement->execute();
    }

    public function updateStatus($status, $idReservation) {
    $query = <<<SQL
    UPDATE 
        reservations
    SET
        status = :status
    WHERE idreservation = :id 
SQL;
    $statement = $this->pdo->prepare($query);
    $statement->bindValue(':status', $status, PDO::PARAM_STR);
    $statement->bindValue(':id', $idReservation); 
    $statement->execute();
    }

}


?>