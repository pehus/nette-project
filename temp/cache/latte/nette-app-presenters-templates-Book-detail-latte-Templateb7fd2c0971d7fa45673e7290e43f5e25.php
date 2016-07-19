<?php
// source: /var/www/nette/app/presenters/templates/Book/detail.latte

class Templateb7fd2c0971d7fa45673e7290e43f5e25 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7a5bf2beb2', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb4092e83fe0_content')) { function _lb4092e83fe0_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="container">

  <div class="row">
      
    <h2><?php echo Latte\Runtime\Filters::escapeHtml($getBook->name, ENT_NOQUOTES) ?></h2>
    
    <p><i><?php echo Latte\Runtime\Filters::escapeHtml($getBook->description, ENT_NOQUOTES) ?></i></p>
    
    <p><?php echo Latte\Runtime\Filters::escapeHtml($getBook->text, ENT_NOQUOTES) ?></p>
    
  </div>
    
</div>

<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php
}}