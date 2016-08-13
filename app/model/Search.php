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
        return $this->database->table('library')->where('name = ?', $string)->fetch();
    }
    
    /**
     * 
     */
    public function fulltext($values)
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
                    library.name LIKE '%$values%'
                OR
                    library_category.name LIKE '%$values%'
                ";
        
        $selection = $this->database->query($sql)->fetchPairs();
        
        $array = [];
        
        foreach($selection as $key => $result)
        {
            $array[] = $key . ' - ' . $result;
        }
        
        return $array;
//        $selection = $this->database->table('library');
//        $selection->where('library_category:name LIKE ?', "%$values%");
//        $selection->where('library:name', "%$values%");
//        return $selection->fetchAll();
        
    }
           
}
