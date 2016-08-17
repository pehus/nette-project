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
    
    public function renderDefault($name)
    {
        //$this->template->searchResult = $this->search->fulltext($name);
    }
    
    /** search form */
    protected function createComponentSearch()
    {
        $form = new Form;
        $form->setMethod('get');       
        $httpRequest = $this->context->getByType('Nette\Http\Request');
        $renderer = $form->getRenderer(); 
                
        $form->addText('name','Nazev knihy: ')
             ->setRequired('Zadejte prosím nazev knihy')
             ->setAttribute('class','form-control')
             ->setAttribute('autocomplete','off')
             ->setValue($httpRequest->getQuery('name'));
        
        $arrayCategory = [];
        foreach($this->category->getAllCategory() as $key => $result)
        {
            Arrays::insertAfter($arrayCategory, 0, [$result['idlibrarycategory'] => $result['name']]);
        }
        
        $form->addSelect('category', 'Kategorie: ', $arrayCategory)
             ->setPrompt('Zvolte kategorii');
        $form->addSubmit('search', 'Vyhledat');
        $form->onSuccess[] = [$this, 'setFormSucceeded'];
        
        $renderer->wrappers['controls']['container'] = 'dl';
        $renderer->wrappers['pair']['container'] = NULL;
        $renderer->wrappers['label']['container'] = 'dt';
        $renderer->wrappers['control']['container'] = 'dd';
        return $form;
    }
        
    /** callback search book, category */
    public function setFormSucceeded($form,$values)
    {
        $this->template->searchResult = $this->search->fulltext($values->name,$values->category);
    }
    
    /**
     * handle Whisperer
     * @param type $text
     * @return json
     */
    public function handleWhisperer($text)
    {
        
        $getList = $this->search->fulltext($text);
        $this->payload->whisperer = array();
        
        foreach($getList as $result)
        {
            $this->payload->whisperer[] = $result['lname'];           
        }        

        $this->terminate();
    }
                   
}
