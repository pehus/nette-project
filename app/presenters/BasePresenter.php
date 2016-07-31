<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    
    protected function createComponentFulltext()
    {
        $form = new UI\Form;
        $form->form->setMethod('get')->setAction('');
        
        
        $renderer = $form->getRenderer(); 
        
        $form->addText('name','')
             ->setRequired('Zadejte prosím nazev knihy')
             ->setAttribute('id','keywords')
             ->setAttribute('class','form-control')
             ->setAttribute('placeholder','Zadejte klicove slovo')
             ->setAttribute('size','50');
        
        $form->addSubmit('fulltext', 'Vyhledat')
             ->setAttribute('class','btn btn-danger');
        
        $form->onSuccess[] = [$this, 'registrationFormSucceeded'];
        
        //$renderer->wrappers['controls']['container'] = 'dl';
        //$renderer->wrappers['pair']['container'] = NULL;
        //$renderer->wrappers['label']['container'] = 'dt';
        //$renderer->wrappers['control']['container'] = 'dd';
        
        return $form;
    }
    
}
