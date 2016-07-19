<?php

namespace App\Presenters;

use Nette;
use App\Model\Category;

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
    
    public function renderDetail($id)
    {
        return $this->template->getCategory = $this->category->getCategory($id);
    }
    
    public function renderDefault()
    {
        return $this->template->getAllCategory = $this->category->getAllCategory();
    }
}
