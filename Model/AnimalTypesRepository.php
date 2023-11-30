<?php

class ServicesRepository
{
    private $pdo;
    public function __construct()
    {
        $this->pdo=Database::getPdo();
    }

    public function getRows(){
        //2 query : all cars
       $query = "SELECT * FROM animalType";
       $statement = $this->pdo->query($query);
       $animalTypes = $statement->fetchAll(PDO::FETCH_ASSOC);
       return $animalTypes;
   }

   // read one row
   public function getRow($id){
    // 3 query car where id = $_GET (prepare)
    $query = "SELECT * FROM animalType where idanimalType=:myId";
    // query prepare with PDO 
    $statement = $this->pdo->prepare($query);
    // definie ":myid"
    $statement->bindValue(':myId', $id, \PDO::PARAM_INT);
    // execute
    $statement->execute();
    // get data 
    $animalType = $statement->fetch(PDO::FETCH_ASSOC);
    return $animalType;
    }
}



?>