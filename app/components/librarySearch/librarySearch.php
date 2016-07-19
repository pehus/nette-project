<?php

namespace App\components\librarySearch;

use Nette\Application\UI;

/**
 * Description of SearchControl
 *
 * @author root
 */
class librarySearch extends UI\Control
{

    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/poll.latte');
        // vložíme do šablony nějaké parametry
        $template->param = $value;
        // a vykreslíme ji
        $template->render();
    }
    
    
}
