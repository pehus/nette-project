<?php

/**
 * Description of HomepagePresenter
 *
 * @author root
 */

namespace App\Presenters;

use Nette;
use App\Model\Category;
use App\Model\Book;

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
    
    /**
     * render default homepage
     */
    public function renderDefault()
    {
        $this->template->getAllCategory = $this->category->getAllCategory();
        
        $this->template->getAllBooks = $this->book->getAllBooks();
    }
        
}
