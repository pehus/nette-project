<?php

namespace App\Presenters;

use Nette;
use Nette\Utils;
use Nette\Utils\Arrays;
use Nette\Application\UI\Form;
use App\Model\Category;
use App\Model\Book;
use App\Model\Search;

/**
 * Description of SearchPresenter
 *
 * @author root
 */
class SearchPresenter extends BasePresenter
{
    
    /** @var App\Model\Category */
    private $category;
    
    /** @var App\Model\Books */
    private $book;
    
    /** @var App\Model\Search */
    private $search;

    public function __construct(Category $category, Book $book, Search $search)
    {
        $this->category = $category;
        
        $this->book = $book;
        
        $this->search = $search;
    }
    
    public function renderDefault()
    {
        return true;
        //$this->template->getCategory;
    }
    
    protected function createComponentSearch()
    {
        $form = new Form;
        //$form->getElementPrototype()->id = "library";
        $renderer = $form->getRenderer(); 
        
        $form->addText('name','Nazev knihy: ')
             ->setRequired('Zadejte prosím nazev knihy')
             ->setAttribute('class','form-control');
        
        $arrayCategory = [];
        foreach($this->category->getAllCategory() as $key => $result)
        {
            Arrays::insertAfter($arrayCategory, 0, [$result['idlibrarycategory'] => $result['name']]);
        }
        
        $form->addSelect('idlibrary_category', 'Kategorie: ', $arrayCategory)
             ->setPrompt('Zvolte kategorii');
        $form->addSubmit('search', 'Vyhledat');
        $form->onSuccess[] = [$this, 'setFormSucceeded'];
        return $form;
    }
    
        
}
