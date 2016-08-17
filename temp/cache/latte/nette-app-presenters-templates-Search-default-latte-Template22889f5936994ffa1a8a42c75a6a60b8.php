<?php
// source: /var/www/nette/app/presenters/templates/Search/default.latte

class Template22889f5936994ffa1a8a42c75a6a60b8 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('31fe71385d', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb4b2cf3d568_content')) { function _lb4b2cf3d568_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>        
<div class="container">

    <h1>Vyhledavani</h1>
    
    <div class="row ">

<?php $_l->tmp = $_control->getComponent("search"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

    </div>
    
<?php if (!empty($searchResult)) { ?>
    <h2>Vyhledane data</h2>
      
    <table class="table table-hover">
        <thead> 
            <tr>
                <th>Poradi:</th>
                <th>Kniha:</th>
                <th>Kategorie:</th>
            </tr>
        </thead>
        
        <tbody>
<?php $iterations = 0; foreach ($searchResult as $key => $result) { ?>            <tr>
                <td><?php echo Latte\Runtime\Filters::escapeHtml($key, ENT_NOQUOTES) ?></td>
                <td><?php echo Latte\Runtime\Filters::escapeHtml($result['lname'], ENT_NOQUOTES) ?></td>
                <td><?php echo Latte\Runtime\Filters::escapeHtml($result['lcname'], ENT_NOQUOTES) ?></td>
            </tr>
<?php $iterations++; } ?>        </tbody>
    </table>
<?php } else { ?>
        <p class="warning">Bohuzel v databazi se nenachazi vyhledany pozadavek.</p>
<?php } ?>
      
    
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