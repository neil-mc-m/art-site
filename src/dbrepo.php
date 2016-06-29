<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 29/06/2016
 * Time: 23:43
 */

namespace Art;


use Doctrine\DBAL\Driver\PDOSqlsrv\Connection;
use \PDO;

/**
 * Class dbrepo
 * @package Art
 * 
 * database repository for manipulating data
 */
class dbrepo
{
    /**
     * @var \Doctrine\DBAL\Connection
     * 
     * connection instance
     */
    public $conn;
    
    /**
     * dbrepo constructor.
     * @param \Doctrine\DBAL\Connection $conn
     */
    public function __construct(\Doctrine\DBAL\Connection $conn)
    {
        $this->conn = $conn;
    }

    /**
     * @return array of image objects
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getAllImages()
    {
        $stmt = $this->conn->prepare('SELECT * FROM image');

        $stmt->execute();
        $img = $stmt->fetchAll(PDO::FETCH_CLASS, '\\Art\\Image');
        return $img;
    }
    public function getAllExhibitions()
    {
        $stmt = $this->conn->prepare('SELECT * FROM exhibition ORDER BY YEAR DESC');
        $stmt->execute();
        $exhib = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $exhib;
    }
    public function getAllSolo()
    {
        $stmt = $this->conn->prepare('SELECT * FROM exhibition WHERE type="solo"');
        $stmt->execute();
        $solo = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $solo;
    }
}