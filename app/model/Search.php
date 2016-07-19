<?php

/**
 * Description of Search
 *
 * @author root
 */

namespace App\Model;

use Nette;

class Search extends Nette\Object
{
    
    private $database;
    
    public function __construct(Nette\Database\Context $database) 
    {
        $this->database = $database;
    }
    
    public function find($string)
    {
        return $this->database->table('library')->fetch();
    }
           
}
