<?php
// source: /var/www/nette/app/presenters/templates/Homepage/default.latte

class Template2e9471a5d822560a68b8214e9ca07502 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('29d6105526', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb83d325f413_content')) { function _lb83d325f413_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>        
<div class="container">

  <div class="row">
      
    <div class="col-sm-6">        
      <div class="panel panel-default">
          
        <div class="panel text-center">
          <h3>Kategorie</h3>
          <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Category:add"), ENT_COMPAT) ?>">Pridat kategorii</a>
        </div>
        <div class="panel-body">
            <ul>
<?php $iterations = 0; foreach ($getAllCategory as $result) { ?>
                    <li>
                        <?php echo Latte\Runtime\Filters::escapeHtml($result->idlibrarycategory, ENT_NOQUOTES) ?>
 - <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Category:detail", array($result->idlibrarycategory)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($result->name, ENT_NOQUOTES) ?></a>
                        <a class="text-danger pull-right col-md-offset-1" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Category:delete", array($result->idlibrarycategory)), ENT_COMPAT) ?>
">Smazat</a>
                        <a class="text-danger pull-right col-md-offset-1" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Category:edit", array($result->idlibrarycategory)), ENT_COMPAT) ?>
">Upravit</a>                      
                    </li>
<?php $iterations++; } ?>
            </ul>
        </div>
          
      </div>
    </div>
      
    <div class="col-sm-6">        
      <div class="panel panel-default">
          
        <div class="panel text-center">
          <h3>Seznam nejnovejsich knih</h3>
          <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Book:add"), ENT_COMPAT) ?>">Pridat knihu</a>
        </div>
        <div class="panel-body">
            <ul>
<?php $iterations = 0; foreach ($getAllBooks as $result) { ?>
                    <li>
                        <a class="pull-left" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Book:detail", array($result->idlibrary)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($result->name, ENT_NOQUOTES) ?></a>
                        <a class="text-danger pull-right col-md-offset-1" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Book:delete", array($result->idlibrary)), ENT_COMPAT) ?>">Smazat</a>
                        <a class="text-danger pull-right col-md-offset-1" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Book:edit", array($result->idlibrary)), ENT_COMPAT) ?>">Upravit</a>
                        <a class="text-danger pull-right col-md-offset-1" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Product:detail", array($result->idlibrary)), ENT_COMPAT) ?>">JSON</a> 
                    </li>
<?php $iterations++; } ?>
            </ul>
        </div>
          
      </div>
    </div>

  </div>
    
</div>
    
            
    
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start(function () {});}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php
}}