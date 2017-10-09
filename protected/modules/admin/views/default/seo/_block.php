<?php
global $menu;
$menu = $settings;

function input($controller, $action, $placeholder, $type)
{
    global $menu;

    $controller = mb_strtolower($controller);
    $action     = mb_strtolower($action);

    parse_str(urldecode($menu), $output);

    $val = isset($output[$controller][$action][$type])
                ? $output[$controller][$action][$type]
                : '';

    $name = $controller.'['.$action.']['.$type.']';
    return <<<HTML
            <input name="{$name}" type="text" value="{$val}" placeholder="{$placeholder}" class="span12" />
HTML;

}

foreach ($blocks as $block) :

    $name       = $block['name'];
    $controller = $block['controller'];
    $items      = $block['items'];

?>
<div class="span4 widget-box collapsed" style="margin: 10px 10px 0 0">
    <div class="widget-header">
        <h5><?=tt($name)?></h5>

        <div class="widget-toolbar">
            <a data-action="collapse" href="#">
                <i class="icon-chevron-down"></i>
            </a>
        </div>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <ol class="dd-list">
                <?php foreach ($items as $action => $name): ?>
                    <li class="dd-item" >
                        <div class="dd-handle row">
                            <?=tt($name)?>
                            <?php
                                foreach (array('Ua', 'Ru', 'En') as $language){
                                    echo input($controller, $action, 'Title '.$language, 'title'.$language);
                                    echo input($controller, $action, 'Description '.$language, 'description'.$language);
                                }
                            ?>
                            </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</div>
<?php
endforeach;