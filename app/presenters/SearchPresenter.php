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
        $this->template->searchResult = $this->convertString($name);
    }
    
    /** search form */
    protected function createComponentSearch()
    {
        $form = new Form;
        $form->setMethod('get');       
        //$form->getElementPrototype()->id = "library";
        $renderer = $form->getRenderer(); 
        
        $form->addText('name','Nazev knihy: ')
             ->setRequired('Zadejte prosím nazev knihy')
             ->setAttribute('class','form-control')
             ->setAttribute('autocomplete','off');
        
        $arrayCategory = [];
        foreach($this->category->getAllCategory() as $key => $result)
        {
            Arrays::insertAfter($arrayCategory, 0, [$result['idlibrarycategory'] => $result['name']]);
        }
        
        $form->addSelect('idlibrary_category', 'Kategorie: ', $arrayCategory)
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
    public function setFormSucceeded($form, $values)
    {
        
        $this->search->fulltext($values);
            
        $this->flashMessage('Příspěvek byl úspěšně upraven.', 'success');
        $this->redirect('Homepage:');

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
            $this->payload->whisperer[] = $result;           
        }        

        $this->terminate();
    }
    
    /**
     * convert search result string
     * @param string $name {first is name book second is name category}
     * @return array $array
     */
    private function convertString($name)
    {
        //first is name book second is name category
        $dataString = $this->search->fulltext($name);
        
        $array = [];
        foreach($dataString as $result)
        {
            $exp = explode('-', $result);
            $array[] = [ 'book' => $exp[0], 'category' => $exp[1] ];
        }
  
        return $array;
    }
                
}
