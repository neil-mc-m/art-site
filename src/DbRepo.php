<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 29/06/2016
 * Time: 23:43
 */

namespace Art;

use \PDO;
use Doctrine\DBAL\Connection;
/**
 * Class DbRepo
 * @package Art
 * 
 * database repository for manipulating data
 */
class DbRepo
{
    /**
     * @var \Doctrine\DBAL\Connection
     * 
     * connection instance
     */
    public $conn;
    
    /**
     * DbRepo constructor.
     * @param \Doctrine\DBAL\Connection $conn
     */
    public function __construct(Connection $conn)
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
        $img = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $img;
    }
    public function getAllCollage()
    {
        $stmt = $this->conn->prepare('SELECT * FROM image WHERE medium LIKE "%collage%"');
        $stmt->execute();
        $img = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $img;
    }
    public function getAllOil()
    {
        $stmt = $this->conn->prepare('SELECT * FROM image WHERE medium LIKE "%oil%"');
        $stmt->execute();
        $img = $stmt->fetchAll(PDO::FETCH_OBJ);
        
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
        $stmt = $this->conn->prepare('SELECT * FROM exhibition WHERE type="solo" ORDER BY YEAR DESC');
        $stmt->execute();
        $solo = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $solo;
    }
    public function getAllGroup()
    {
        $stmt = $this->conn->prepare('SELECT * FROM exhibition WHERE type="group" ORDER BY YEAR DESC');
        $stmt->execute();
        $group = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $group;
    }
    public function getAllHermit()
    {
        $stmt = $this->conn->prepare('SELECT * FROM exhibition WHERE type="hermit" ORDER BY YEAR DESC');
        $stmt->execute();
        $hermit = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $hermit;
    }
    public function createNewExhibition(array $arr)
    {
        $count = $this->conn->insert('exhibition', $arr);
        return $count;
    }
    public function deleteExhibitionById($id)
    {
        $count = $this->conn->delete('exhibition', array('id' => $id ));
        return $count;
    }

}

