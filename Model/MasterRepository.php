<?php 
require_once "UsersRepository.php";
class MasterRepository extends UsersRepository {
    private $pdo;
    public function __construct() {
        $this->pdo=Database::getPdo();
    }

    public function getRow(int $id) : array {
        $query =<<<SQL
        SELECT * 
        FROM 
            donkeySitter.masters m
        LEFT JOIN 
            donkeySitter.pets p ON m.idmaster = master_id
        LEFT JOIN 
            donkeySitter.animalTypes at ON p.animalType_id = at.idanimalType
        LEFT JOIN 
        donkeySitter.sizes s ON p.size_id = s.idsize
        LEFT JOIN donkeySitter.users u
        ON m.userid = u.iduser 
        WHERE 
        idmaster = :idmaster
SQL;
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':idmaster', $id, \PDO::PARAM_INT); 
        $statement->execute();
        $master = $statement->fetch(PDO::FETCH_ASSOC);
        return $master;

    }

    public function insertRow(Masters $master, $ageDifference) {
        
        try {
            if (empty($master->getFirstName()) || (empty($master->getLastName())) || (empty($master->getPhoneNb())) || (empty($master->getBirthDate())) || (empty($master->getStreet())) || (empty($master->getPostalCode())) || (empty($master->getCity())) || (empty($master->getStreet()))){
                $errorMessages[] = "Veuillez renseigner tous les champs obligatoires.";
            }

            if ((!empty($master->getBirthDate())) && $ageDifference->y < 18) {
                $errorMessages[] ="Vous devez avoir au moins 18 ans pour vous inscrire.";
            }

            if (!empty($errorMessages)) {
                throw new Exception (implode("<br><center>", $errorMessages));
            }
            $query=<<<SQL
            INSERT INTO 
                masters (lastName, firstName, phoneNb, birthDate, masterStreet, masterPostalCode, masterCity, userid)
            VALUES
            (:lastName, :firstName, :phoneNb, :birthDate, :street, :postalCode, :city, :userid)
SQL;
            $statement = $this->pdo->prepare($query); 
            $statement->bindValue(':firstName', $master->getFirstName(), \PDO::PARAM_STR);
            $statement->bindValue(':lastName', $master->getLastName(), \PDO::PARAM_STR);
            $statement->bindValue(':phoneNb', $master->getPhoneNb(), \PDO::PARAM_STR);
            $statement->bindValue(':birthDate', $master->getBirthDate(), \PDO::PARAM_STR);
            $statement->bindValue(':street', $master->getStreet(), \PDO::PARAM_STR);
            $statement->bindValue(':postalCode', $master->getPostalCode(), \PDO::PARAM_STR);
            $statement->bindValue(':city', $master->getCity(), \PDO::PARAM_STR);
            $statement->bindValue(':userid', $master->getUserid(), \PDO::PARAM_INT);
            $statement->execute();
            $lastInsertId = $this->pdo->lastInsertId();
            return $lastInsertId;
        } catch (Exception $e) {
            echo "<center>Erreur : " . $e->getMessage();
        }
    }

    public function insertRowWithImage(Masters $master, $checkImage, $ageDifference) {
        try {
            if ($checkImage !== UPLOAD_ERR_OK) {
                $errorMessages[] = "Erreur lors du téléchargement du fichier.";
            }
            $imageBlob = base64_encode(file_get_contents($master->getImage()));
            if (empty($master->getFirstName()) || (empty($master->getLastName())) || (empty($master->getPhoneNb())) || (empty($master->getBirthDate())) || (empty($master->getStreet())) || (empty($master->getPostalCode())) || (empty($master->getCity())) || (empty($master->getStreet()))) {
                $errorMessages[] = "Veuillez renseigner tous les champs obligatoires.";
            }

            if ((!empty($master->getBirthDate())) && $ageDifference->y < 18) {
                $errorMessages[] ="Vous devez avoir au moins 18 ans pour vous inscrire.";
            }

            if (!empty($errorMessages)) {
                throw new Exception (implode("<br><center>", $errorMessages));
            }
        
        $query=<<<SQL
        INSERT INTO 
            masters (lastName, firstName, phoneNb, birthDate, image, masterStreet, masterPostalCode, masterCity, userid)
        VALUES
        (:lastName, :firstName, :phoneNb, :birthDate, :imageBlob, :street, :postalCode, :city, :userid)
SQL;
    $statement = $this->pdo->prepare($query); 
    $statement->bindValue(':firstName', $master->getFirstName(), \PDO::PARAM_STR);
    $statement->bindValue(':lastName', $master->getLastName(), \PDO::PARAM_STR);
    $statement->bindValue(':phoneNb', $master->getPhoneNb(), \PDO::PARAM_STR);
    $statement->bindValue(':birthDate', $master->getBirthDate(), \PDO::PARAM_STR);
    $statement->bindParam(':imageBlob', $imageBlob, \PDO::PARAM_LOB);
    $statement->bindValue(':street', $master->getStreet(), \PDO::PARAM_STR);
    $statement->bindValue(':postalCode', $master->getPostalCode(), \PDO::PARAM_STR);
    $statement->bindValue(':city', $master->getCity(), \PDO::PARAM_STR);
    $statement->bindValue(':userid', $master->getUserid(), \PDO::PARAM_INT);
    $statement->execute();
    $lastInsertId = $this->pdo->lastInsertId();
    return $lastInsertId;
        } catch (Exception $e) {
            echo "<center>Erreur : " . $e->getMessage();
        }
    } 

    public function updateRow(Masters $master, $id) {
        $query=<<<SQL
        UPDATE
            masters 
        SET
        lastName = :lastName, firstName = :firstName, phoneNb = :phoneNb, birthDate = :birthDate, masterStreet = :street, masterPostalCode = :postalCode, masterCity = :city
        WHERE idmaster = :myId
    SQL;
        $statement = $this->pdo->prepare($query); 
        $statement->bindValue(':firstName', $master->getFirstName(), \PDO::PARAM_STR);
        $statement->bindValue(':lastName', $master->getLastName(), \PDO::PARAM_STR);
        $statement->bindValue(':phoneNb', $master->getPhoneNb(), \PDO::PARAM_STR);
        $statement->bindValue('birthDate', $master->getBirthDate(), \PDO::PARAM_STR);
        $statement->bindValue(':street', $master->getStreet(), \PDO::PARAM_STR);
        $statement->bindValue(':postalCode', $master->getPostalCode(), \PDO::PARAM_STR);
        $statement->bindValue(':city', $master->getCity(), \PDO::PARAM_STR);
        $statement->bindValue(':myId', $id, \PDO::PARAM_STR);
        $statement->execute();
        }

        



}