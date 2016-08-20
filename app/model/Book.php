<?php

/**
 * Description of Books
 *
 * @author root
 */

namespace App\Model;

use Nette;

Class Book extends Nette\Object
{
    /** @var Nette\Database\Context */
    private $database;
    
    public function __construct(Nette\Database\Context $database) 
    {
        $this->database = $database;
    }
    
    /**
     * get all books
     */
    public function getAllBooks()
    {
        return $this->database->table('library')->order('idlibrary DESC');     
    }
    
    /**
     * get book
     * @param $id
     */
    public function getBook($id)
    {
        return $this->getAllBooks()->get($id);    
    }
    
    /**
     * delete book
     */
    public function deleteBook($id)
    {
        $delete = $this->database->table('library');
        $delete->where('idlibrary = ',(int) $id);
        $delete->delete();
    }
    
    /**
     * edit book
     * @param int $id
     * @param array $data
     */
    public function editBook($id,$data)
    {
        $update = $this->database->table('library');
        $update->where('idlibrary =',(int) $id);
        $update->update($data);
        
        return $update;       
    }
    
    /**
     * add book
     * @param array $data
     */
    public function addBook($data)
    {
        return $this->database->table('library')->insert($data);
    }
    
}

