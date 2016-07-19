<?php
/**
 * Description of BookPresenter
 *
 * @author root
 */

namespace App\Presenters;

use Nette;
use Nette\Utils;
use App\Model\Book;
use App\Model\Category;
use Nette\Application\UI\Form;
use Nette\Utils\Arrays;

class BookPresenter extends BasePresenter
{
    /** @var App\Model\Book */
    public $book;
    
    /** @var App\Model\Category */
    public $category;
            
    
    public function __construct(Book $book, Category $category)
    {
        $this->book = $book;
        $this->category = $category;
    }
    
    /** render detail */
    public function renderDetail($id)
    {
        $this->template->getBook = $this->book->getBook($id);
    }
    
    /** render edit */
    public function renderEdit($id)
    {
        $this->template->editBook = $this->book->getBook($id);
    }
     
    
    
    /** method set data */
    public function setBook()
    {
        $form = new Form;
        $form->getElementPrototype()->id = "library";
        $renderer = $form->getRenderer(); 
        
        $form->addText('name','Nazev: ')
             ->setRequired('Zadejte prosím nazev knihy')
             ->setAttribute('class','form-control');
        
        $arrayCategory = [];
        foreach($this->category->getAllCategory() as $key => $result)
        {
            Arrays::insertAfter($arrayCategory, 0, [$result['idlibrarycategory'] => $result['name']]);
        }
        
        $form->addSelect('idlibrary_category', 'Kategorie: ', $arrayCategory)
             ->setPrompt('Zvolte kategorii')
             ->setRequired('Zvolte kategorii do ktere chcete zaradit knihu');        
        
        $form->addTextArea('description','Popis: ')
             ->setRequired('Zadejte prosím strucny popisek knihy')
             ->setAttribute('class','form-control')
             ->setAttribute('rows','5');
        
        $form->addTextArea('text','Text: ')
             ->setRequired('Zadejte prosím text knihy')
             ->setAttribute('class','form-control')
             ->setAttribute('rows','10');
        
        $renderer->wrappers['controls']['container'] = 'dl';
        $renderer->wrappers['pair']['container'] = NULL;
        $renderer->wrappers['label']['container'] = 'dt';
        $renderer->wrappers['control']['container'] = 'dd';
                
        return $form;
    }
    
    /** create form new book */
    protected function createComponentFormBook()
    {
        $form = $this->setBook();
        $form->addSubmit('addBook', 'Ulozit')
             ->setAttribute('class', 'btn btn-default');
        $form->onSuccess[] = [$this, 'setFormSucceeded'];
        return $form;
    }
    
          
    /** edit book */
    public function actionEdit($id)
    {
        
        $book = $this->book->getBook($id);
        if (!$book) 
        {
            $this->error('Příspěvek nebyl nalezen');
        }
        
        $this['formBook']->setDefaults($book->toArray());
        
    }
    
    /** delete book */
    public function actionDelete($id)
    {
        $this->book->deleteBook($id);
        
        $this->flashMessage('Příspěvek byl úspěšně smazan.', 'success');
        $this->redirect('Homepage:');
    }
       

    /** callback add new, edit book */
    public function setFormSucceeded($form, $values)
    {
        
        $id = $this->getParameter('id');

        if ($id) 
        {           
            $this->book->editBook($id,$values);
            
            $this->flashMessage('Příspěvek byl úspěšně upraven.', 'success');
            $this->redirect('Homepage:');
        } 
        else 
        {
            $this->book->addBook($values);
            
            $this->flashMessage('Příspěvek byl úspěšně pridan.', 'success');
            $this->redirect('Homepage:');
        }

    }
    
    
}
