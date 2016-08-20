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
        
    public function __construct(Nette\Database\Context $database) 
    {
        $this->database = $database;
    }
    
    /**
     * get category
     * @param int $id
     * @return array
     */
    public function getCategory($id)
    {
        return $this->getAllCategory()->get($id);
    }
    
    /**
     * get all category
     */
    public function getAllCategory()
    {
        return $this->database->table('library_category');
    }
    
    /**
     * add category
     * @param array $data
     */
    public function addCategory($data)
    {        
        return $this->database->table('library_category')->insert($data);
        
    }
    
    /**
     * edit category
     * @param int $id
     * @param array $data
     */
    public function editCategory($id,$data)
    {
        $update = $this->database->table('library_category');
        $update->where('idlibrarycategory =',(int) $id);
        $update->update($data);
        
        return $update;       
    }
    
    /**
     * delete category
     * @param int $id
     */
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
