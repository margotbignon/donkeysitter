<?php
require_once "ResidenceTypes.php";
class ResidenceTypesRepository
{
    private $pdo;
    public function __construct()
    {
        $this->pdo=Database::getPdo();
    }

    public function getRows(){
        //2 query : all cars
       $query = "SELECT * FROM residenceTypes";
       $statement = $this->pdo->query($query);
       $residencesDB = $statement->fetchAll(PDO::FETCH_ASSOC);
       $residences = [];
       foreach ($residencesDB as $residenceDB) {
            $residences[] = new ResidenceTypes ($residenceDB['idresidenceType'], $residenceDB['residenceType']);
       }
       
       return $residences;
   }

   // read one row
   public function getRow($id){
    // 3 query car where id = $_GET (prepare)
    $query = "SELECT * FROM residenceType where idresidenceType=:myId";
    // query prepare with PDO 
    $statement = $this->pdo->prepare($query);
    // definie ":myid"
    $statement->bindValue(':myId', $id, \PDO::PARAM_INT);
    // execute
    $statement->execute();
    // get data 
    $residence = $statement->fetch(PDO::FETCH_ASSOC);
    return $residence;
    }
}



?>