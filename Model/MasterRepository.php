<?php 
require_once "UsersRepository.php";
class MasterRepository extends UsersRepository {
    private $pdo;
    public function __construct() {
        $this->pdo=Database::getPdo();
    }

    public function getRow(int $id) : array {
        $query = "SELECT * FROM masters WHERE idmaster = :myId"; 
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':myId', $id, \PDO::PARAM_INT); 
        $statement->execute();
        $master = $statement->fetch(PDO::FETCH_ASSOC);
        return $master;
    }

    public function insertRow(Masters $master, $confirmPassword, $ageDifference) {
        
        try {
            if (empty($master->getFirstName()) || (empty($master->getLastName())) || (empty($master->getPhoneNb())) || (empty($master->getEmail())) || (empty($master->getPassWord())) || (empty($master->getBirthDate())) || (empty($master->getStreet())) || (empty($master->getPostalCode())) || (empty($master->getCity())) || (empty($master->getStreet())) || (empty($confirmPassword))){
                $errorMessages[] = "Veuillez renseigner tous les champs obligatoires.";
            }
            if ($master->getPassWord() !== $confirmPassword) {
                $errorMessages[] = "Les mots de passes saisis ne correspondent pas";
            }
            if ((!empty($master->getBirthDate())) && $ageDifference->y < 18) {
                $errorMessages[] ="Vous devez avoir au moins 18 ans pour vous inscrire.";
            }

            if (!empty($errorMessages)) {
                throw new Exception (implode("<br><center>", $errorMessages));
            }
            $query=<<<SQL
            INSERT INTO 
                masters (lastName, firstName, phoneNb, email, password, birthDate, masterStreet, masterPostalCode, masterCity)
            VALUES
            (:lastName, :firstName, :phoneNb, :email, :passWord, :birthDate, :street, :postalCode, :city)
SQL;
            $statement = $this->pdo->prepare($query); 
            $statement->bindValue(':firstName', $master->getFirstName(), \PDO::PARAM_STR);
            $statement->bindValue(':lastName', $master->getLastName(), \PDO::PARAM_STR);
            $statement->bindValue(':phoneNb', $master->getPhoneNb(), \PDO::PARAM_STR);
            $statement->bindValue(':email', $master->getEmail(), \PDO::PARAM_STR);
            $statement->bindValue('passWord', password_hash($master->getPassWord(), PASSWORD_DEFAULT), \PDO::PARAM_STR);
            $statement->bindValue('birthDate', $master->getBirthDate(), \PDO::PARAM_STR);
            $statement->bindValue('street', $master->getStreet(), \PDO::PARAM_STR);
            $statement->bindValue('postalCode', $master->getPostalCode(), \PDO::PARAM_STR);
            $statement->bindValue('city', $master->getCity(), \PDO::PARAM_STR);
            $statement->execute();
            $lastInsertId = $this->pdo->lastInsertId();
            return $lastInsertId;
        } catch (Exception $e) {
            echo "<center>Erreur : " . $e->getMessage();
        }
    }

    public function insertRowWithImage(Masters $master, $checkImage, $confirmPassword, $ageDifference) {
        try {
            if ($checkImage !== UPLOAD_ERR_OK) {
                $errorMessages[] = "Erreur lors du téléchargement du fichier.";
            }
            $imageBlob = file_get_contents($master->getImage());
            if (empty($master->getFirstName()) || (empty($master->getLastName())) || (empty($master->getPhoneNb())) || (empty($master->getEmail())) || (empty($master->getPassWord())) || (empty($master->getBirthDate())) || (empty($master->getStreet())) || (empty($master->getPostalCode())) || (empty($master->getCity())) || (empty($master->getStreet())) || (empty($confirmPassword))){
                $errorMessages[] = "Veuillez renseigner tous les champs obligatoires.";
            }
            if ($master->getPassWord() !== $confirmPassword) {
                $errorMessages[] = "Les mots de passes saisis ne correspondent pas";
            }
            if ((!empty($master->getBirthDate())) && $ageDifference->y < 18) {
                $errorMessages[] ="Vous devez avoir au moins 18 ans pour vous inscrire.";
            }

            if (!empty($errorMessages)) {
                throw new Exception (implode("<br><center>", $errorMessages));
            }
        
        $query=<<<SQL
        INSERT INTO 
            masters (lastName, firstName, phoneNb, email, password, birthDate, image, masterStreet, masterPostalCode, masterCity)
        VALUES
        (:lastName, :firstName, :phoneNb, :email, :passWord, :birthDate, :imageBlob, :street, :postalCode, :city)
SQL;
    $statement = $this->pdo->prepare($query); 
    $statement->bindValue(':firstName', $master->getFirstName(), \PDO::PARAM_STR);
    $statement->bindValue(':lastName', $master->getFirstName(), \PDO::PARAM_STR);
    $statement->bindValue(':phoneNb', $master->getPhoneNb(), \PDO::PARAM_STR);
    $statement->bindValue(':email', $master->getEmail(), \PDO::PARAM_STR);
    $statement->bindValue('passWord', $master->getPassWord(), \PDO::PARAM_STR);
    $statement->bindValue('birthDate', $master->getBirthDate(), \PDO::PARAM_STR);
    $statement->bindParam('imageBlob', $imageBlob, \PDO::PARAM_LOB);
    $statement->bindValue('street', $master->getStreet(), \PDO::PARAM_STR);
    $statement->bindValue('postalCode', $master->getPostalCode(), \PDO::PARAM_STR);
    $statement->bindValue('city', $master->getCity(), \PDO::PARAM_STR);
    $statement->execute();
        } catch (Exception $e) {
            echo "<center>Erreur : " . $e->getMessage();
        }
    } 

    public function updateRow(string $firstName, string $lastName, string $phoneNb, string $email, string $passWord, string $birthDate, string $image, string $street, string $postalCode, string $city, string $description, string $petterSince, string $residenceTypeId, int $id) {
        $query=<<<SQL
        UPDATE
            masters 
        SET
        lastName = :lastName, firstName = :firstName, phoneNb = :phoneNb, email = :email, password : :passWord, birthDate = :birthDate, image = :image, masterStreet = :street, masterPostalCode = :postalCode, masterCity = :city
        WHERE idmaster = :myId
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
        $statement->bindValue('myId', $id, \PDO::PARAM_STR);
        $statement->execute();
        }

}