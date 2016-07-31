<?php

/**
 * Description of Category
 *
 * @author root
 */

namespace App\Model;

use Nette;

class Category extends Nette\Object
{
    
    /** @var Nette\Database\Context */
    private $database;
    
    private $book;
    
    public function __construct(Nette\Database\Context $database) 
    {
        $this->database = $database;
    }
    
    public function getCategory($id)
    {
        return $this->getAllCategory()->get($id);
    }
    
    public function getAllCategory()
    {
        return $this->database->table('library_category');
    }
      
    public function addCategory($data)
    {        
        return $this->database->table('library_category')->insert($data);
        
    }
    
    public function editCategory($id,$data)
    {
        $update = $this->database->table('library_category');
        $update->where('idlibrarycategory =',(int) $id);
        $update->update($data);
        
        return $update;       
    }
    
    public function deleteCategory($id)
    {        
        $deleteCategory = $this->database->table('library_category');
        $deleteCategory->where('idlibrarycategory = ',(int) $id);
        $deleteCategory->delete();
        
        $deleteBook = $this->database->table('library');
        $deleteBook->where('idlibrary_category = ',(int) $id);
        $deleteBook->delete();
        
    }
    
}
