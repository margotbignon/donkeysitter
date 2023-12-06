<?php 
class UsersLoginRepository {
    private $pdo;
    public function __construct() {
        $this->pdo=Database::getPdo();
    }

    public function getUsertoLogin($email, $password) {
        try {
            if (empty($email)) {
                $errorMessages[] = "Veuillez renseigner votre email";
            }
            if (empty($password)) {
                $errorMessages[] = "Veuillez renseigner votre mot de passe";
            }
    
            $query = <<< SQL
            SELECT u.*, ps.idpetSitter, m.idmaster FROM donkeySitter.users u
            LEFT JOIN donkeySitter.petSitters ps 
            ON u.iduser = ps.userid
            LEFT JOIN donkeySitter.masters m
            ON u.iduser = m.userid
            WHERE u.email = :email
    SQL;
            $statement = $this->pdo->prepare($query);
            $statement->bindValue(':email', $email, \PDO::PARAM_STR);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);


            if (!empty($errorMessages)) {
                throw  new Exception (implode("<br><center>", $errorMessages)."</center>");
            }
            return $user;
        } catch (Exception $e) {
            echo "<center>Erreur : " . $e->getMessage();
        }
    }

    public function insertRow(UserLogin $userLogin, $confirmPassword) {
        
        try {
               
               
            if (empty($userLogin->getEmail()) || (empty($userLogin->getPassWord())) || (empty($confirmPassword))){
                $errorMessages[] = "Veuillez renseigner tous les champs obligatoires.";
            }
            if ($userLogin->getPassWord() !== $confirmPassword) {
                $errorMessages[] = "Les mots de passes saisis ne correspondent pas";
            }
            if (!empty($errorMessages)) {
                throw new Exception (implode("<br><center>", $errorMessages));
            }
            $query=<<<SQL
            INSERT INTO 
                users (email, password, role)
            VALUES
            (:email, :passWord, :role)
SQL;
            $statement = $this->pdo->prepare($query); 
            $statement->bindValue(':email', $userLogin->getEmail(), \PDO::PARAM_STR);
            $statement->bindValue(':passWord', password_hash($userLogin->getPassWord(), PASSWORD_DEFAULT), \PDO::PARAM_STR);
            $statement->bindValue(':role', $userLogin->getRole(), \PDO::PARAM_STR);
            $statement->execute();
            $lastInsertId = $this->pdo->lastInsertId();
            return $lastInsertId;
    } catch (Exception $e) {
        echo "<center>Erreur : " . $e->getMessage();
        }
    }
}