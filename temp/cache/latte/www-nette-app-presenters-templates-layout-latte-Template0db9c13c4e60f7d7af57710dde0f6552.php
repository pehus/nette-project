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
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/netteForms.min.js"></script>
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

if ($_l->extends) { ob_start(function () {});}

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

	<title><?php if (isset($_b->blocks["title"])) { ob_start(function () {}); Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>Nette Sandbox</title>

	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/style.css">
	<meta name="viewport" content="width=device-width">
	<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

</head>

<body>
    
        <nav class="navbar">
            <div class="container center-block">
                
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    <ul class="nav navbar-nav left">
<?php $iterations = 0; foreach ($menuItems as $item => $link) { ?>                        <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link($link), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($item, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; } ?>                    </ul>

                    <div id="search" class="navbar-form navbar-right">

<?php $_l->tmp = $_control->getComponent("fulltext"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

                        <div class="whisperer bg-info dropdown-menu"></div>
                        
                    </div>
                        
                </div>
           
            </div> <!--container-fluid-->
        </nav> <!--navbar navbar-default-->
    
<?php $iterations = 0; foreach ($flashes as $flash) { ?>	<div<?php if ($_l->tmp = array_filter(array('flash', $flash->type))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
        
        <div class="jumbotron text-center">
            <span class="glyphicon glyphicon-leaf logo-large"></span>
            <h1>Knihovna</h1>
            <p>Databaze knih</p>
        </div>
        
<?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?>

        <div class="jumbotron text-center">
            <p>
                created by pehus 2016
                <a href="https://github.com/pehus" title="https://github.com/pehus">
                    https://github.com/pehus
                </a>
            </p>
        </div>
        
<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>

            <script>
                              
                $('form#frm-fulltext input#keywords').keyup(function(event) {
                    
                    var value = $(this).val();
                    
                    $.getJSON(<?php echo Latte\Runtime\Filters::escapeJs($_control->link("Search:")) ?>, {'do':'whisperer','text': value}, function(payload) {
                      
                        var items = [];
                        $.each( payload, function( key, val ) {
                              
                            var string = '<p class="whisperer-result" data="'+val+'" >'+ val.join('</p><p class="whisperer-result" >') + '</p>';  
                              
                            items.push(string);
                            
                        });
                          
                        $('.whisperer').html(items);
                        $('.whisperer').addClass('show');
                      
                    });
                       
                });
                
                $('.whisperer p').click(function() {
                    
                   var value = $(this).text();
                    
                    console.log(value);
                    
                    //$('form#frm-fulltext input#keywords').val(value);
                    
                });
                
                $(".whisperer").on("click", "p.whisperer-result", function() {
                    
                    var value = $(this).text();
                    
                    $('form#frm-fulltext input#keywords').val(value);
                    
                });

            </script>           
</body>
</html>
<?php
}}