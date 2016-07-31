<?php

namespace App\Presenters;

use Nette;
//use Nette\Application\UI;
use App\Model\Category;
use App\Model\Book;

/**
 * Description of HomepagePresenter
 *
 * @author root
 */
class HomepagePresenter extends BasePresenter
{
    
    /** @var App\Model\Category */
    private $category;
    
    /** @var App\Model\Books */
    private $book;

    public function __construct(Category $category, Book $book)
    {
        $this->category = $category;
        
        $this->book = $book;
    }
    
    public function renderDefault()
    {
        $this->template->getAllCategory = $this->category->getAllCategory();
        
        $this->template->getAllBooks = $this->book->getAllBooks();
        //$this->template->getCategory;
    }
        
}
