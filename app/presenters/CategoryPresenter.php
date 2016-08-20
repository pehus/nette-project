<?php

/**
 * Description of CategoryPresenter
 *
 * @author root
 */

namespace App\Presenters;

use Nette;
use App\Model\Category;
use App\Model\Book;
use Nette\Application\UI\Form;

class CategoryPresenter extends BasePresenter
{
    /** @var App\Model\Category */
    public $category;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    
    /** 
     * render detail category
     * @param int $id
     */
    public function renderDetail($id)
    {
        return $this->template->getCategory = $this->category->getCategory($id);
    }
    
    /** 
     * render default category
     */
    public function renderDefault()
    {
        return $this->template->getAllCategory = $this->category->getAllCategory();
    }
    
    /** 
     * create form
     */
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
    
    /** 
     * create form new category 
     */
    protected function createComponentFormCategory()
    {
        $form = $this->setCategory();
        $form->addSubmit('addCategory', 'Ulozit')
             ->setAttribute('class', 'btn btn-default');
        $form->onSuccess[] = [$this, 'setFormSucceeded'];
        return $form;
    }
    
    /** 
     * callback add new, edit book 
     * @param $form
     * @param $values
     */
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
    
    /** 
     * edit category 
     * @param $id
     */
    public function actionEdit($id)
    {
        $category = $this->category->getCategory($id);
        if (!$category) 
        {
            $this->error('Kategorie nebyla nalezena');
        }
        
        $this['formCategory']->setDefaults($category->toArray());
    }
    
    /** 
     * delete category 
     * @param int $id
     */
    public function actionDelete($id)
    {
        $this->category->deleteCategory($id);
        
        $this->flashMessage('Příspěvek byl úspěšně smazan.', 'success');
        $this->redirect('Homepage:');
    }
  
}
