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
    
    public function getCategory($id)
    {
        return $this->getAllCategory()->get($id);
    }
    
    public function getAllCategory()
    {
        return $this->database->table('library_category');
    }
        
    
    
}
