<?php
namespace Core;
use PDO;

abstract class BaseModel{
    private $pdo;
    protected $table;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function All(){
        $query = "select * from {$this->table}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function getPost($id){
        $query = "select * from {$this->table} where id =:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
}