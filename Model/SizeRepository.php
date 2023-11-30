<?php

class SizeRepository
{
    private $pdo;
    public function __construct()
    {
        $this->pdo=Database::getPdo();
    }

    public function getRows(){
        //2 query : all cars
       $query = "SELECT * FROM sizes";
       $statement = $this->pdo->query($query);
       $sizes = $statement->fetchAll(PDO::FETCH_ASSOC);
       return $sizes;
   }

   // read one row
   public function getRow($id){
    // 3 query car where id = $_GET (prepare)
    $query = "SELECT * FROM sizes where idsize=:myId";
    // query prepare with PDO 
    $statement = $this->pdo->prepare($query);
    // definie ":myid"
    $statement->bindValue(':myId', $id, \PDO::PARAM_INT);
    // execute
    $statement->execute();
    // get data 
    $size = $statement->fetch(PDO::FETCH_ASSOC);
    return $size;
    }
}



?>