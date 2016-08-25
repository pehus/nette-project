<?php

/**
 * Description of Product
 *
 * @author root
 */

namespace App\Model;

use Nette;

class Product extends \Nette\Object
{
    /** @var Nette\Database\Context */
    private $database;
        
    public function __construct(Nette\Database\Context $database) 
    {
        $this->database = $database;
    }
    
    /**
     * get all product
     * #@return array
     */
    public function getAllProduct()
    {
        return $this->database->table('library');
    }
    
    /**
     * get product
     * @param int $id
     * #@return array
     */
    public function getProduct($id)
    {
        return $this->getAllProduct()->get($id);
    }
    
}
