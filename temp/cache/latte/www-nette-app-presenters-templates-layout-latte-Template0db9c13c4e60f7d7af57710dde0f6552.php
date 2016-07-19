<?php
// source: /var/www/nette/app/presenters/templates/@layout.latte

class Template0db9c13c4e60f7d7af57710dde0f6552 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('ca5b0dccb9', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbfbf6d01d92_head')) { function _lbfbf6d01d92_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb55e27fb972_scripts')) { function _lb55e27fb972_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery-1.12.0.min.js"></script>
	<script src="https://nette.github.io/resources/js/netteForms.min.js"></script>
        <!--  Bootstrap start  -->        
        <link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">    
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/bootstrap.min.js"></script>
        <!--  Bootstrap end  -->
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title><?php if (isset($_b->blocks["title"])) { ob_start(); Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>Nette Sandbox</title>

	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/style.css">
	<meta name="viewport" content="width=device-width">
	<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

</head>

<body>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>	<div<?php if ($_l->tmp = array_filter(array('flash', $flash->type))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
        
        <div class="jumbotron text-center">
            <span class="glyphicon glyphicon-leaf logo-large"></span>
            <h1>Knihovna</h1>
            <p>Databaze knih</p>
            
            <form id="ajax-fulltext-search" class="form-inline" action="" method="get">
                <input id="keywords" type="text" class="form-control" size="50" placeholder="Zadejte klicove slovo">
                <button type="button" class="btn btn-danger">Hledat</button>
            </form>                                  
        </div>
        
<?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>
        
            <script>
                
                $('form#ajax-fulltext-search').keyup(function() {
                
                    var keywords = $('form#ajax-fulltext-search input#keywords').val();
                
                    console.log(keywords);
                
                });
                
            </script>
</body>
</html>
<?php
}}