<?php

/**
 * Base presenter for all application presenters.
 *
 * @author root
 */

namespace App\Presenters;

use Nette;
use App\Model\Search;
use Nette\Application\UI;

abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    
    /** 
     * create form fulltext
     * @return $form
     */
    protected function createComponentFulltext()
    {
        $form = new UI\Form;
        $form->form->setMethod('get')->setAction('/search/?do=search-submit');
        $httpRequest = $this->context->getByType('Nette\Http\Request');
        $renderer = $form->getRenderer();
        
        $form->addText('name','')
             ->setRequired('Zadejte prosím nazev knihy')
             ->setAttribute('id','keywords')
             ->setAttribute('class','form-control ajax')
             ->setAttribute('placeholder','Zadejte klicove slovo')
             ->setAttribute('size','50')
             ->setAttribute('autocomplete','off')
             ->setValue($httpRequest->getQuery('name'));
        
        $form->addSubmit('fulltext', 'Vyhledat')
             ->setAttribute('class','btn btn-danger');
        
        $form->onSuccess[] = [$this, 'setFormSucceeded'];
        
        $renderer->wrappers['controls']['container'] = 'div';
        $renderer->wrappers['pair']['container'] = NULL;
        
        return $form;
    }
           
    /** 
     * create menu
     */
    public function beforeRender()
    {
        parent::beforeRender();
        $this->template->menuItems = [
            'Domů' => 'Homepage:',
            'Kategorie' => 'Category:',
            'Knihy' => 'Book:',
            'Vyhledavani' => 'Search:',
        ];
    }

}
