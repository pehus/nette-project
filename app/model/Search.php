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
    /** @var \Nette\Database\Context */
    private $database;
    
    public function __construct(Nette\Database\Context $database) 
    {
        $this->database = $database;
    }
    
    /**
     * find data
     * @return array $array
     * @param string $string
     */
    public function find($string)
    {
        return $this->database->table('library')->where('name = ?', $string)->fetch();
    }
    
    /**
     * fulltext
     * @return array $array
     * @param string $name
     */
    public function fulltext($name)
    {
        
        $sql = "
                SELECT 
                    library.name AS lname,
                    library_category.name AS lcname
                FROM 
                    library
                LEFT JOIN
                    library_category ON(library.idlibrary_category = library_category.idlibrarycategory) 
                WHERE
                    library.name LIKE ?
                OR
                    library_category.name LIKE ? 
                ";
              
        $selection = $this->database->query($sql, '%'.$name.'%', '%'.$name.'%')->fetchPairs();
        
        $array = [];
        
        foreach($selection as $key => $result)
        {
            $array[] = $key . ' - ' . $result;
        }
        
        return $array;
        
    }
           
}
