<?php
require_once "Services.php";
class ServicesRepository
{
    private $pdo;
    public function __construct()
    {
        $this->pdo=Database::getPdo();
    }

    public function getRows(){
        //2 query : all services
       $query = "SELECT * FROM services";
       $statement = $this->pdo->query($query);
       $servicesDB = $statement->fetchAll(PDO::FETCH_ASSOC);
       $services = [];
        foreach ($servicesDB as $serviceDB) {
            $services[] = new Services($serviceDB['idservice'], $serviceDB['serviceType']);

        }
       return $services;
   }

   // read one row
   public function getRow($id){
    // 3 query service where id = $_GET (prepare)
    $query = "SELECT * FROM services where idservice=:myId";
    // query prepare with PDO 
    $statement = $this->pdo->prepare($query);
    // definie ":myid"
    $statement->bindValue(':myId', $id, \PDO::PARAM_INT);
    // execute
    $statement->execute();
    // get data 
    $service = $statement->fetch(PDO::FETCH_ASSOC);
    return $service;
    }
}



?>