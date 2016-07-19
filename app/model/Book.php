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
    private $database;
    
    public function __construct(Nette\Database\Context $database) 
    {
        $this->database = $database;
    }
    
    public function getAllBooks()
    {
        return $this->database->table('library')->order('idlibrary DESC');     
    }
    
    public function getBook($id)
    {
        return $this->getAllBooks()->get($id);    
    }
    
    public function deleteBook($id)
    {
        $delete = $this->database->table('library');
        $delete->where('idlibrary = ',(int) $id);
        $delete->delete();
    }
    
    public function editBook($id,$data)
    {
        $update = $this->database->table('library');
        $update->where('idlibrary =',(int) $id);
        $update->update($data);
        
        return $update;       
    }
    
    public function addBook($data)
    {
        return $this->database->table('library')->insert($data);
    }
    
}

