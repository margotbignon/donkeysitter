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

    public function insertRow(string $firstName, string $lastName, string $phoneNb, string $email, string $passWord, string $birthDate, string $image, string $street, string $postalCode, string $city) {
        $query=<<<SQL
        INSERT INTO 
            masters (lastName, firstName, phoneNb, email, password, birthDate, image, masterStreet, masterPostalCode, masterCity)
        VALUES
        (:lastName, :firstName, :phoneNb, :email, :passWord, :birthDate, :image, :street, :postalCode, :city)
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