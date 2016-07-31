<?php

namespace App\Presenters;

use Nette;
use App\Model\Category;
use App\Model\Book;
use Nette\Application\UI\Form;

/**
 * Description of CategoryPresenter
 *
 * @author root
 */
class CategoryPresenter extends BasePresenter
{
    /** @var App\Model\Category */
    public $category;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    
    /** render detail category*/
    public function renderDetail($id)
    {
        return $this->template->getCategory = $this->category->getCategory($id);
    }
    
    /** render default category */
    public function renderDefault()
    {
        return $this->template->getAllCategory = $this->category->getAllCategory();
    }
    
    /** method set data */
    public function setCategory()
    {
        $form = new Form;
        $form->getElementPrototype()->id = "category";
        $renderer = $form->getRenderer(); 
        
        $form->addText('name','Nazev: ')
             ->setRequired('Zadejte prosím nazev kategorie')
             ->setAttribute('class','form-control');
        
        $form->addTextArea('description','Popis: ')
             ->setRequired('Zadejte prosím popis kategorie')
             ->setAttribute('rows','5')
             ->setAttribute('class','form-control');
                
        $renderer->wrappers['controls']['container'] = 'dl';
        $renderer->wrappers['pair']['container'] = NULL;
        $renderer->wrappers['label']['container'] = 'dt';
        $renderer->wrappers['control']['container'] = 'dd';
                
        return $form;
    }
    
    /** create form new category */
    protected function createComponentFormCategory()
    {
        $form = $this->setCategory();
        $form->addSubmit('addCategory', 'Ulozit')
             ->setAttribute('class', 'btn btn-default');
        $form->onSuccess[] = [$this, 'setFormSucceeded'];
        return $form;
    }
    
    /** callback add new, edit book */
    public function setFormSucceeded($form, $values)
    {
        
        $id = $this->getParameter('id');

        if ($id) 
        {           
            $this->category->editCategory($id,$values);
            
            $this->flashMessage('Kategorie byla úspěšně upravena.', 'success');
            $this->redirect('Homepage:');
        } 
        else 
        {
            $this->category->addCategory($values);
            
            $this->flashMessage('Kategorie byla úspěšně pridana.', 'success');
            $this->redirect('Homepage:');
        }

    }
    
    /** edit category */
    public function actionEdit($id)
    {
        $category = $this->category->getCategory($id);
        if (!$category) 
        {
            $this->error('Kategorie nebyla nalezena');
        }
        
        $this['formCategory']->setDefaults($category->toArray());
    }
    
    /** delete category */
    public function actionDelete($id)
    {
        $this->category->deleteCategory($id);
        
        $this->flashMessage('Příspěvek byl úspěšně smazan.', 'success');
        $this->redirect('Homepage:');
    }
  
}
